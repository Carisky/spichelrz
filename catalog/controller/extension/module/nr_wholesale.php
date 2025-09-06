<?php
class ControllerExtensionModuleNrWholesale extends Controller
{

    /** @var Log */
    protected $logger;

    public function __construct($registry)
    {
        parent::__construct($registry);
        // создаём логгер, файл будет в system/storage/logs/wholesale.log
        $this->logger = new Log('wholesale.log');
    }

    /** Универсальный метод логирования */
    protected function log($message, $context = [])
    {
        $time = date("Y-m-d H:i:s");
        $logMessage = "[$time] $message";
        if (!empty($context)) {
            $logMessage .= ' | ' . json_encode($context, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        $this->logger->write($logMessage);
    }

    public function index()
    {

        $this->log("Загрузка wholesale index", [
            'customer_id' => $this->customer->getId(),
            'group_id'    => $this->customer->getGroupId(),
        ]);


        $this->load->language('checkout/buy');

        if ($this->customer->getGroupId() != 2) {
            $this->log("Редирект: не wholesale клиент");
            $data['redirect'] = $this->url->link('common/home', '', true);
        } else {
            $this->log("Инициализация wholesale для клиента", ['id' => $this->customer->getId()]);
            $this->load->model('catalog/category');
            $this->load->model('catalog/product');
            $this->load->model('tool/image');
            $this->load->model('account/address');
            $this->updateShippingMethods();
            $this->updatePaymentMethods();
            $arPIDs = array(); //AG 14-04-2025
            // Получаем все корневые категории
            $categories = $this->model_catalog_category->getCategories(0);
            foreach ($categories as &$category) {
                $products = $this->model_catalog_product->getProducts([
                    'filter_category_id' => $category['category_id'],
                    'sort'               => 'pd.name',
                ]);

                $productsShift = array(); //AG 14-04-2025
                foreach ($products as $product) {
                    if (in_array($product['product_id'], $arPIDs)) continue;
                    $arPIDs[] = $product['product_id'];
                    $productsShift[] = $product;
                }
                $products = $productsShift;
                unset($productsShift); //AG END

                foreach ($products as &$product) { //
                    //print_r($product); 
                    $price = round($product['price'] * (1 - floatval($this->config->get('module_nr_wholesale_discount')) / 100), 2);
                    $image = $product['image'] ? $product['image'] : 'placeholder.png';
                    $product['in_pack'] = trim($product['jan']) ? (int)$product['jan'] : 6;
                    if ($product['minimum'] > $product['in_pack']) {
                        $product['minimum'] = ceil($product['minimum'] / $product['in_pack']) - 1;
                    } else {
                        $product['minimum'] = 0;
                    }
                    $product['thumb'] = $this->model_tool_image->resize($image, $this->config->get('theme_default_image_cart_width'), $this->config->get('theme_default_image_cart_height'));
                    $product['price_abs'] = $price;
                    $product['old_price'] = $this->currency->format(round($product['old_price'] * (1 - floatval($this->config->get('module_nr_wholesale_discount')) / 100), 2), $this->session->data['currency']);
                    $product['price1'] = $this->currency->format($price, $this->session->data['currency']);
                    $product['href'] = $this->url->link('product/product', '&product_id=' . $product['product_id'], true);
                }
                unset($product);

                $category['products'] = $products;
            }
            unset($category);
            $data['categories'] = $categories;

            // Получаем адреса пользователя
            $data['addresses'] = $this->model_account_address->getAddresses();
            $data['address_id'] = $this->customer->getAddressId();

            // Автозаполнение формы данными пользователя (если он залогинен)
            if (!empty($this->customer->getId())) {
                //AG
                $this->load->model('account/customer');
                $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
                $cost_fields = json_decode($customer_info['custom_field'], true);

                $data['address'] = [
                    'email'      => $this->customer->getEmail(),
                    'telephone'  => $this->customer->getTelephone(),
                    'firstname'  => $this->customer->getFirstName(),
                    'lastname'   => $this->customer->getLastName(),
                    'address_1'  => $cost_fields[4],
                    'address_id' => $this->customer->getAddressId() ? $this->customer->getAddressId() : 0,
                    'comment'    => '',
                    'company'    => $cost_fields[1],
                    'nip'        => $cost_fields[3],
                    'postcode'   => $cost_fields[7],
                    'city'       => $cost_fields[6],
                ];

                $this->session->data['shipping_address'] = $data['address'];
            } else {
                $data['address'] = [
                    'email'      => '',
                    'telephone'  => '',
                    'firstname'  => '',
                    'lastname'   => '',
                    'address_1'  => '',
                    'address_id' => 0,
                    'comment'    => ''
                ];
            }
            // Сохраняем адрес в сессию, если еще не установлен
            if (empty($this->session->data['wholesale_address'])) {
                $this->session->data['wholesale_address'] = $data['address'];
            }

            $data['cart_products'] = empty($this->session->data['wholesale_products']) ? [] : $this->session->data['wholesale_products'];
            $data['totals'] = $this->calculate(false);
            $data['shipping'] = $this->shipping();
            $data['payment'] = $this->payment();
        }

        return $this->load->view('extension/module/nr_wholesale', $data);
    }

    public function shipping()
    {
        $data['shipping_methods'] = $this->updateShippingMethods();
        $data['code'] = $this->session->data['shipping_method']['code'];
        $data['error'] = isset($this->session->data['errors']) ? $this->session->data['errors'] : [];

        return $this->load->view('checkout/shipping_method', $data);
    }

    public function payment()
    {

        $data['payment_methods'] = $this->updatePaymentMethods();
        $data['code'] = $this->session->data['payment_method']['code'];
        $data['error'] = isset($this->session->data['errors']) ? $this->session->data['errors'] : [];
        $data['payment_form'] = $this->load->controller('extension/payment/' . $this->session->data['payment_method']['code']);

        return $this->load->view('checkout/payment_method', $data);
    }

    protected function updatePaymentMethods()
    {
        $method_data = array();
        $total = 10; //$this->cart->getSubTotal();
        $this->load->model('setting/extension');
        // $recurring = false;//$this->cart->hasRecurringProducts();

        $results = $this->model_setting_extension->getExtensions('payment');
        foreach ($results as $result) {
            if ($this->config->get('payment_' . $result['code'] . '_status')) {
                $this->load->model('extension/payment/' . $result['code']);
                $method = $this->{'model_extension_payment_' . $result['code']}->getMethod($this->session->data['shipping_address'], $total);
                if ($method) {
                    // if ($recurring) {
                    // 	if (property_exists($this->{'model_extension_payment_' . $result['code']}, 'recurringPayments') and $this->{'model_extension_payment_' . $result['code']}->recurringPayments()) {
                    // 		$method_data[$result['code']] = $method;
                    // 	}
                    // } else {
                    $method_data[$result['code']] = $method;
                    // }
                }
            }
        }

        $sort_order = array();
        foreach ($method_data as $key => $value) {
            $sort_order[$key] = $value['sort_order'];
        }
        array_multisort($sort_order, SORT_ASC, $method_data);

        $this->session->data['payment_methods'] = $method_data;

        if (!empty($this->session->data['payment_method']) and !isset($method_data[$this->session->data['payment_method']['code']])) unset($this->session->data['payment_method']);

        if (empty($this->session->data['payment_method'])) {
            foreach ($method_data as $method) {
                if (!empty($method['code'])) {
                    $this->session->data['payment_method'] = $method;
                    break;
                }
            }
        }

        return $method_data;
    }

    protected function updateShippingMethods()
    {
        // Определяем два метода доставки: самовывоз и курьер
        $self_pickup = [
            'code'       => 'self.pickup',
            'title'      => 'Odbiór osobisty',
            'cost'       => 0,
            'text'       => $this->currency->format(0, $this->session->data['currency']),
            'sort_order' => 1
        ];
        $courier = [
            'code'       => 'courier',
            'title'      => 'Kurier',
            'cost'       => 30,
            'text'       => $this->currency->format(30, $this->session->data['currency']),
            'sort_order' => 2
        ];
        // Формируем структуру, аналогичную оригинальной (quote - массив)
        $method_data = [
            'self' => [
                'code'      => 'self.pickup',
                'quote'     => [$self_pickup],
                'sort_order' => $self_pickup['sort_order']
            ],
            'courier' => [
                'code'      => 'courier',
                'quote'     => [$courier],
                'sort_order' => $courier['sort_order']
            ]
        ];
        $this->session->data['shipping_methods'] = $method_data;
        // Если ранее метод не выбран - по умолчанию самовывоз
        if (empty($this->session->data['shipping_method'])) {
            $this->session->data['shipping_method'] = $self_pickup;
        }
        return $method_data;
    }

    public function change_shipping()
    {
        $this->log("Смена способа доставки", [
            'method' => $this->request->post['shipping_method']
        ]);
        $shipping_code = $this->request->post['shipping_method'];
        $shipping_methods = $this->updateShippingMethods();
        foreach ($shipping_methods as $method) {
            if (!empty($method['quote'])) {
                foreach ($method['quote'] as $quote) {
                    if ($quote['code'] == $shipping_code) {
                        $this->session->data['shipping_method'] = $quote;
                        break 2;
                    }
                }
            }
        }
        $data = $this->calculate(true);
        $this->sendJSON($data);
    }


    public function change_address()
    {
        $address_id = $this->request->post['address']['address_id'];
        $this->load->model('account/address');
        $info = $this->model_account_address->getAddress($address_id);
        $address = $info['zone_id'] ? $this->model_account_address->getZone($info['zone_id']) : '';
        $address .= ($address ? ', ' : '') . $info['city'];
        $address .= $info['postcode'] ? ', ' . $info['postcode'] : (isset($this->session->data['wholesale_address']['postcode']) ? $this->session->data['wholesale_address']['postcode'] : '');
        $address .= ', ' . $info['address_1'];
        $phone = !empty($info['custom_field'][4]) ? $info['custom_field'][4] : '';
        if (!$phone && !empty($this->session->data['wholesale_address']['telephone'])) {
            $phone = $this->session->data['wholesale_address']['telephone'];
        }
        if (!$phone) {
            $phone = $this->customer->getTelephone();
        }

        $data_address = [
            'email'      => $this->customer->getEmail(),
            'telephone'  => $phone,
            'firstname'  => $info['firstname'],
            'lastname'   => $info['lastname'],
            'address_1'  => $address,
            'address_id' => $address_id,
            'comment'    => $this->request->post['address']['comment']
        ];
        foreach ($data_address as $key => $value) {
            if ($value) {
                $this->session->data['wholesale_address'][$key] = $value;
            }
        }
        exit();
    }

    public function calculate($json = true)
    {
        $this->log("Расчёт итогов START", [
            'json' => $json,
            'posted_products_count' => isset($this->request->post['product']) ? count($this->request->post['product']) : null
        ]);

        // 1) Обновляем корзину/адрес из POST при ajax-вызове
        if ($json) {
            $posted = isset($this->request->post['product']) ? $this->request->post['product'] : [];
            $cart   = isset($this->session->data['wholesale_products']) ? $this->session->data['wholesale_products'] : [];

            foreach ($posted as $pid => $row) {
                $cart[$pid] = array_merge(isset($cart[$pid]) ? $cart[$pid] : [], $row);
            }
            $this->session->data['wholesale_products'] = $cart;

            $address = isset($this->request->post['address'])
                ? $this->request->post['address']
                : (isset($this->session->data['wholesale_address']) ? $this->session->data['wholesale_address'] : []);
            $this->session->data['wholesale_address'] = $address;
        }

        $cart_products = isset($this->session->data['wholesale_products']) ? $this->session->data['wholesale_products'] : [];

        if (empty($cart_products)) {
            $zero = $this->currency->format(0, $this->session->data['currency']);
            $data = [
                'items'          => 0,
                'subtotal'       => $zero,
                'discount_pct'   => 0,
                'discount_value' => $zero,
                'shipping'       => $zero,
                'tax'            => $zero,
                'total'          => $zero
            ];
            $this->log("Расчёт итогов EMPTY CART", $data);
            if ($json) $this->sendJSON($data);
            return $data;
        }

        $this->load->model('catalog/product');

        $primary_discount = (float)$this->config->get('module_nr_wholesale_discount');

        $amount_gross_before_tier = 0.0; // брутто после primary, ДО лестницы
        $amount_tax_before_tier   = 0.0;

        $count_items = 0;

        // 2) Счёт после primary-скидки
        foreach ($cart_products as $p) {
            $qty = isset($p['quantity']) ? (int)$p['quantity'] : 0;
            if ($qty <= 0) continue;

            $info = $this->model_catalog_product->getProduct((int)$p['product_id']);
            if (!$info) continue;

            $base      = (float)$info['price'];
            $price_net = round($base * (1 - $primary_discount / 100), 2);

            $vat_unit = $info['tax_class_id']
                ? round($this->tax->getTax($price_net, $info['tax_class_id']), 2)
                : 0.0;

            $amount_gross_before_tier += round(($price_net + $vat_unit) * $qty, 2);
            $amount_tax_before_tier   += round($vat_unit * $qty, 2);
            $count_items              += $qty;
        }

        $subtotal_gross = round($amount_gross_before_tier, 2); // брутто до лестницы

        // 3) Определяем лестничную скидку по сумме брутто
        if ($subtotal_gross >= (float)$this->config->get('module_nr_wholesale_sum3')) {
            $discount2 = (float)$this->config->get('module_nr_wholesale_discount3');
        } elseif ($subtotal_gross >= (float)$this->config->get('module_nr_wholesale_sum2')) {
            $discount2 = (float)$this->config->get('module_nr_wholesale_discount2');
        } elseif ($subtotal_gross >= (float)$this->config->get('module_nr_wholesale_sum1')) {
            $discount2 = (float)$this->config->get('module_nr_wholesale_discount1');
        } else {
            $discount2 = 0.0;
        }

        // 4) Пересчёт с учётом лестницы (если есть)
        $amount_gross_after_tier = $subtotal_gross;
        $amount_tax_after_tier   = $amount_tax_before_tier;

        if ($discount2 > 0) {
            $amount_gross_after_tier = 0.0;
            $amount_tax_after_tier   = 0.0;

            foreach ($cart_products as $p) {
                $qty = isset($p['quantity']) ? (int)$p['quantity'] : 0;
                if ($qty <= 0) continue;

                $info = $this->model_catalog_product->getProduct((int)$p['product_id']);
                if (!$info) continue;

                $base      = (float)$info['price'];
                $price_net = round($base * (1 - $primary_discount / 100), 2);
                $price_net = round($price_net * (1 - $discount2 / 100), 2);

                $vat_unit = $info['tax_class_id']
                    ? round($this->tax->getTax($price_net, $info['tax_class_id']), 2)
                    : 0.0;

                $amount_gross_after_tier += round(($price_net + $vat_unit) * $qty, 2);
                $amount_tax_after_tier   += round($vat_unit * $qty, 2);
            }
        }

        $discount_value = round($subtotal_gross - $amount_gross_after_tier, 2);

        // 5) Доставка
        $shipping = isset($this->session->data['shipping_method']['cost'])
            ? (float)$this->session->data['shipping_method']['cost']
            : 30.0;

        $total_gross = round($amount_gross_after_tier, 2);

        if ($total_gross > 600) {
            $shipping = 0.0;
        } else {
            $total_gross += $shipping;
        }

        // 6) Ответ
        $data = [
            'items'            => $count_items,
            'subtotal'         => $this->currency->format($subtotal_gross, $this->session->data['currency']),
            'discount'         => $discount2 . ' %', // <<< вернуть старое поле (только процент)
            'discount_pct'     => $discount2,        // оставить и числовое поле
            'discount_value'   => $this->currency->format($discount_value, $this->session->data['currency']),
            'shipping'         => $this->currency->format($shipping, $this->session->data['currency']),
            'tax'              => $this->currency->format($amount_tax_after_tier, $this->session->data['currency']),
            'total'            => $this->currency->format($total_gross, $this->session->data['currency']),
            'raw' => [
                'subtotal'       => $subtotal_gross,
                'discount_value' => $discount_value,
                'discount_pct'   => $discount2,
                'shipping'       => $shipping,
                'tax'            => $amount_tax_after_tier,
                'total'          => $total_gross,
            ],
        ];


        $this->log("Расчёт итогов DONE", [
            'items'              => $count_items,
            'subtotal_gross'     => $subtotal_gross,
            'discount2_pct'      => $discount2,
            'discount_value'     => $discount_value,
            'tax_sum'            => $amount_tax_after_tier,
            'shipping'           => $shipping,
            'total_gross'        => $total_gross
        ]);

        if ($json) $this->sendJSON($data);
        return $data;
    }



    public function order()
    {
        $this->log("Создание заказа", [
            'address'  => $this->request->post['address'],
            'products' => $this->request->post['product'],
        ]);

        $address  = $this->request->post['address'];
        $products = $this->request->post['product'];

        // Актуализируем методы доставки/оплаты из POST (если переданы)
        $this->session->data['shipping_address'] = $address;

        if (isset($this->request->post['shipping_method'])) {
            $shipping_methods = $this->updateShippingMethods();
            foreach ($shipping_methods as $method) {
                if (!empty($method['quote'])) {
                    foreach ($method['quote'] as $quote) {
                        if ($quote['code'] == $this->request->post['shipping_method']) {
                            $this->session->data['shipping_method'] = $quote;
                            break 2;
                        }
                    }
                }
            }
        }

        if (isset($this->request->post['payment_method'])) {
            $payment_methods = $this->updatePaymentMethods();
            if (isset($payment_methods[$this->request->post['payment_method']])) {
                $this->session->data['payment_method'] = $payment_methods[$this->request->post['payment_method']];
            }
        }

        // Валидация
        $error = $this->validateAddress($address, $products);
        if (!$error && (empty($products) || !array_filter($products, fn($p) => !empty($p['quantity'])))) {
            $error['general'] = $this->language->get('error_empty_products');
        }
        if ($error) {
            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 400 Bad Request');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode(['error' => $error]));
            return;
        }

        $this->session->data['wholesale_address'] = $address;

        // Сервисные загрузки
        $this->load->language('checkout/buy');
        $this->load->model('localisation/country');
        $this->load->model('checkout/order');
        $this->load->model('catalog/product');
        $this->load->model('account/customer');

        // Базовые данные заказа
        $order_data = [];
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['store_id']       = $this->config->get('config_store_id');
        $order_data['store_name']     = $this->config->get('config_name');
        $order_data['store_url']      = $order_data['store_id'] ? $this->config->get('config_url') : (($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER);

        $order_data['customer_id']        = $this->customer->getId();
        $order_data['customer_group_id']  = $this->customer->getGroupId();
        $order_data['firstname']          = $address['firstname'];
        $order_data['lastname']           = $address['lastname'];
        $order_data['email']              = $address['email'];
        $order_data['telephone']          = $address['telephone'];
        $order_data['comment']            = $address['comment'];

        // custom_field: частично перезапишем значениями из адреса
        $customer_info            = $this->model_account_customer->getCustomer($this->customer->getId());
        $order_data['custom_field'] = json_decode($customer_info['custom_field'], true);
        $order_data['custom_field'][1] = $address['company'];
        $order_data['custom_field'][3] = $address['nip'];
        $order_data['custom_field'][6] = $address['city'];
        $order_data['custom_field'][7] = $address['postcode'];
        $order_data['custom_field'][4] = $address['address_1'];

        // Обновим профиль клиента
        $client_info = $address;
        $client_info['custom_field']['account'][1] = $address['company'];
        $client_info['custom_field']['account'][3] = $address['nip'];
        $client_info['custom_field']['account'][4] = $address['address_1'];
        $client_info['custom_field']['account'][6] = $address['city'];
        $client_info['custom_field']['account'][7] = $address['postcode'];
        $this->model_account_customer->editCustomer($this->customer->getId(),  $client_info);

        // Платёжные/доставочные поля
        $order_data['payment_company']       = $order_data['custom_field'][1];
        $order_data['payment_firstname']     = $order_data['firstname'];
        $order_data['payment_lastname']      = $order_data['lastname'];
        $order_data['payment_address_1']     = $address['address_1'];
        $order_data['payment_address_2']     = '';
        $order_data['payment_city']          = $order_data['custom_field'][6];
        $order_data['payment_postcode']      = $order_data['custom_field'][7];
        $order_data['payment_zone']          = '';
        $order_data['payment_zone_id']       = 0;
        $order_data['payment_country']       = '';
        $order_data['payment_country_id']    = $this->config->get('config_country_id');
        $order_data['payment_address_format'] = '';
        $order_data['payment_custom_field']  = $order_data['custom_field'];

        $order_data['shipping_firstname']     = $order_data['payment_firstname'];
        $order_data['shipping_lastname']      = $order_data['payment_lastname'];
        $order_data['shipping_company']       = $order_data['payment_company'];
        $order_data['shipping_address_1']     = $order_data['payment_address_1'];
        $order_data['shipping_address_2']     = $order_data['payment_address_2'];
        $order_data['shipping_city']          = $order_data['payment_city'];
        $order_data['shipping_postcode']      = $order_data['payment_postcode'];
        $order_data['shipping_zone']          = $order_data['payment_zone'];
        $order_data['shipping_zone_id']       = $order_data['payment_zone_id'];
        $order_data['shipping_country']       = $order_data['payment_country'];
        $order_data['shipping_country_id']    = $order_data['payment_country_id'];
        $order_data['shipping_address_format'] = $order_data['payment_address_format'];
        $order_data['shipping_custom_field']  = $order_data['payment_custom_field'];

        $order_data['payment_method'] = $this->session->data['payment_method']['title'] ?? '';
        $order_data['payment_code']   = $this->session->data['payment_method']['code']  ?? '';

        // 1) Формируем товары: цена после primary, налог per-item, сохраняем tax_class_id
        $primary_discount = (float)$this->config->get('module_nr_wholesale_discount');

        $amount    = 0.0; // брутто после primary, до лестницы
        $amounttax = 0.0;

        $order_data['products'] = [];

        foreach ($products as $product) {
            $q = (int)($product['quantity'] ?? 0);
            if ($q <= 0) continue;

            $product_info = $this->model_catalog_product->getProduct((int)$product['product_id']);
            if (!$product_info) continue;

            $base          = (float)$product_info['price'];
            $price_net     = round($base * (1 - $primary_discount / 100), 2);
            $tax_class_id  = (int)$product_info['tax_class_id'];
            $vat_unit      = $tax_class_id ? round($this->tax->getTax($price_net, $tax_class_id), 2) : 0.0;

            $amount    += round(($price_net + $vat_unit) * $q, 2);
            $amounttax += round($vat_unit * $q, 2);

            $order_data['products'][] = [
                'product_id'   => (int)$product['product_id'],
                'name'         => $product_info['name'],
                'model'        => $product_info['model'],
                'option'       => [],
                'download'     => [],
                'quantity'     => $q,
                'subtract'     => $product_info['subtract'],
                'price'        => $price_net,                     // уже после primary
                'total'        => round($price_net * $q, 2),
                'tax'          => $vat_unit,
                'tax_class_id' => $tax_class_id,                  // <<< сохраняем
                'reward'       => 0,
                'image'        => ($product_info['image'] ?: ''),
                'sku'          => $product_info['sku'],
                'weight'       => $product_info['weight'],
            ];
        }

        $subtotal = round($amount, 2); // брутто до лестницы

        // 2) Лестничная скидка от суммы брутто до лестницы
        if ($subtotal >= (float)$this->config->get('module_nr_wholesale_sum3')) $discount = (float)$this->config->get('module_nr_wholesale_discount3');
        elseif ($subtotal >= (float)$this->config->get('module_nr_wholesale_sum2')) $discount = (float)$this->config->get('module_nr_wholesale_discount2');
        elseif ($subtotal >= (float)$this->config->get('module_nr_wholesale_sum1')) $discount = (float)$this->config->get('module_nr_wholesale_discount1');
        else   $discount = 0.0;

        // 3) Применяем лестницу per-item корректно
        if ($discount > 0) {
            $amount    = 0.0;
            $amounttax = 0.0;

            foreach ($order_data['products'] as &$p) {
                $p['price'] = round($p['price'] * (1 - $discount / 100), 2);
                $p['total'] = round($p['price'] * $p['quantity'], 2);
                $p['tax']   = round($this->tax->getTax($p['price'], (int)$p['tax_class_id']), 2);

                $amount    += round(($p['price'] + $p['tax']) * $p['quantity'], 2);
                $amounttax += round($p['tax'] * $p['quantity'], 2);
            }
            unset($p);
        }

        $total_after_discounts = round($amount, 2);
        $totaldiscount_value   = round($subtotal - $total_after_discounts, 2);

        // 4) Доставка
        $shipping_cost = !empty($this->session->data['shipping_method']['cost'])
            ? (float)$this->session->data['shipping_method']['cost']
            : 0.0;

        $order_data['shipping_method'] = $this->session->data['shipping_method']['title'] ?? 'Metoda dostawy';
        $order_data['shipping_code']   = $this->session->data['shipping_method']['code']  ?? '';
        //TODO : change hardcode discount to dynamic which can be managed from admin panel
        if ($total_after_discounts > 600) {
            $shipping_cost = 0.0;
        }

        $total = $total_after_discounts + $shipping_cost;

        // 5) Totals
        $order_data['totals'] = [
            [
                'code'       => 'sub_total',
                'title'      => $this->language->get('column_total'),
                'value'      => $subtotal,
                'sort_order' => 1
            ],
            [
                'code'       => 'nr_wholesale',
                'title'      => $this->language->get('text_discount') . ' ' . $discount . '%',
                'value'      => $totaldiscount_value,
                'sort_order' => 2
            ],
            [
                'code'       => 'shipping',
                'title'      => $order_data['shipping_method'],
                'value'      => $shipping_cost,
                'sort_order' => 3
            ],
            [
                'code'       => 'tax',
                'title'      => 'VAT',
                'value'      => $amounttax,
                'sort_order' => 3
            ],
            [
                'code'       => 'total',
                'title'      => $this->language->get('text_total'),
                'value'      => $total,
                'sort_order' => 4
            ],
        ];
        $order_data['total'] = $total;

        // 6) Тех.поля
        $order_data['affiliate_id']   = 0;
        $order_data['commission']     = 0;
        $order_data['marketing_id']   = 0;
        $order_data['tracking']       = '';
        $order_data['language_id']    = $this->config->get('config_language_id');
        $order_data['currency_id']    = $this->currency->getId($this->session->data['currency']);
        $order_data['currency_code']  = $this->session->data['currency'];
        $order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
        $order_data['ip']             = $this->request->server['REMOTE_ADDR'];
        $order_data['forwarded_ip']   = !empty($this->request->server['HTTP_X_FORWARDED_FOR']) ? $this->request->server['HTTP_X_FORWARDED_FOR'] : (!empty($this->request->server['HTTP_CLIENT_IP']) ? $this->request->server['HTTP_CLIENT_IP'] : '');
        $order_data['user_agent']      = $this->request->server['HTTP_USER_AGENT'] ?? '';
        $order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'] ?? '';

        // 7) Создание заказа
        $order_id = $this->model_checkout_order->addOrder($order_data);
        $this->session->data['order_id'] = $order_id;

        // Статус
        $status = $order_data['payment_code']
            ? $this->config->get('payment_' . $order_data['payment_code'] . '_order_status_id')
            : $this->config->get('config_order_status_id');

        $this->model_checkout_order->addOrderHistory($order_id, $status);

        // Оплата
        $payment = $this->load->controller('extension/payment/' . $this->session->data['payment_method']['code']);

        // Очистка wholesale-корзины
        unset($this->session->data['wholesale_products']);

        $this->log("Заказ создан", [
            'order_id' => $order_id,
            'total'    => $order_data['total'],
            'customer' => $this->customer->getId()
        ]);

        $this->sendJSON(['order_id' => $order_id, 'payment' => $payment]);
    }


    protected function sendJSON($data)
    {
        header("Content-type: application/json");
        header('Content-Type: charset=utf-8');
        echo json_encode($data); //, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
        exit();
    }

    protected function validateAddress($address, $products)
    {
        $error = array();
        $this->load->language('checkout/buy');
        if (empty($products)) {
            $error['warning'] = $this->language->get('error_email');
            return $error;
        }

        if ((utf8_strlen(trim($address['firstname'])) < 1) || (utf8_strlen(trim($address['firstname'])) > 32))
            $error['firstname'] = $this->language->get('error_firstname');
        if ((utf8_strlen(trim($address['lastname'])) < 1) || (utf8_strlen(trim($address['lastname'])) > 32))
            $error['lastname'] = $this->language->get('error_lastname');
        if ((utf8_strlen(trim($address['company'])) < 1) || (utf8_strlen(trim($address['company'])) > 255))
            $error['company'] = $this->language->get('error_company');
        if ((utf8_strlen(trim($address['nip'])) < 1) || (utf8_strlen(trim($address['nip'])) > 10) || !preg_match('/^[0-9]+$/', trim($address['nip'])))
            $error['nip'] = $this->language->get('error_nip');
        if ((utf8_strlen(trim($address['city'])) < 1) || (utf8_strlen(trim($address['city'])) > 70))
            $error['city'] = $this->language->get('error_city');
        if ((utf8_strlen(trim($address['postcode'])) < 1) || (utf8_strlen(trim($address['postcode'])) > 6))
            $error['postcode'] = $this->language->get('error_postcode');
        if ((utf8_strlen($address['email']) > 96) || !filter_var($address['email'], FILTER_VALIDATE_EMAIL))
            $error['email'] = $this->language->get('error_email');
        if ((utf8_strlen($address['telephone']) < 7) || (utf8_strlen($address['telephone']) > 20))
            $error['telephone'] = $this->language->get('error_telephone');
        if (!trim($address['address_1']))
            $error['address_1'] = $this->language->get('error_shipping_data');
        // метод доставки
        if (empty($this->session->data['shipping_method']['code'])) {
            $error['shipping_method'] = $this->language->get('error_shipping_method');
        }
        // метод оплаты
        if (empty($this->session->data['payment_method']['code'])) {
            $error['payment_method'] = $this->language->get('error_payment_method');
        }
        return $error;
    }
}
