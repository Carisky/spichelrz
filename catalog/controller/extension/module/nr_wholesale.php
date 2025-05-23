<?php
class ControllerExtensionModuleNrWholesale extends Controller
{
    public function index()
    {
        $this->load->language('checkout/buy');

        if ($this->customer->getGroupId() != 2) {
            $data['redirect'] = $this->url->link('common/home', '', true);
        } else {
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
        if ($json) {
            // Если данные переданы, используем их, иначе берем из сессии
            $cart_products = isset($this->request->post['product'])
                ? $this->request->post['product']
                : (isset($this->session->data['wholesale_products']) ? $this->session->data['wholesale_products'] : []);
            $this->session->data['wholesale_products'] = $cart_products;

            $address = isset($this->request->post['address'])
                ? $this->request->post['address']
                : (isset($this->session->data['wholesale_address']) ? $this->session->data['wholesale_address'] : []);
            $this->session->data['wholesale_address'] = $address;
        } else {
            $cart_products = isset($this->session->data['wholesale_products']) ? $this->session->data['wholesale_products'] : [];
        }

        if (empty($cart_products)) {
            $amount = $this->currency->format(0, $this->session->data['currency']);
            $data = [
                'subtotal' => $amount,
                'discount' => $amount,
                'total'    => $amount
            ];

            if ($json) {
                $this->sendJSON($data);
            }
            return $data;
        }

        $this->load->model('catalog/product');
        $primary_discount = $this->config->get('module_nr_wholesale_discount');
        $amount = 0;
        $amounttax = 0;
        foreach ($cart_products as &$product) {
            if (!$product['quantity']) continue;
            $product_info = $this->model_catalog_product->getProduct($product['product_id']); //print_r($product_info);
            $price = round($product['price'] - ($product['price'] / 100 * $primary_discount), 2);
            $vat = round(($product_info['tax_class_id'] ? $this->tax->getTax($price, $product_info['tax_class_id']) : 0), 2);
            $amount += round(($price + $vat) * $product['quantity'], 2);
            $amounttax += round($vat * $product['quantity'], 2);
        }

        $subtotal = round($amount, 2); //$subtotal = round($amount - ($amount / 100 * $primary_discount), 2);

        if ($subtotal >= $this->config->get('module_nr_wholesale_sum3')) {
            $discount = $this->config->get('module_nr_wholesale_discount3');
        } elseif ($subtotal >= $this->config->get('module_nr_wholesale_sum2')) {
            $discount = $this->config->get('module_nr_wholesale_discount2');
        } elseif ($subtotal >= $this->config->get('module_nr_wholesale_sum1')) {
            $discount = $this->config->get('module_nr_wholesale_discount1');
        } else {
            $discount = 0;
        }

        if ($discount > 0) {
            $amount = 0;
            $amounttax = 0;
            foreach ($cart_products as &$product) {
                if (!$product['quantity']) continue;
                $product_info = $this->model_catalog_product->getProduct($product['product_id']); //print_r($product_info);
                $price = round($product['price'] - ($product['price'] / 100 * $primary_discount), 2);
                $price = round($price - ($price / 100 * $discount), 2);
                $vat = round(($product_info['tax_class_id'] ? $this->tax->getTax($price, $product_info['tax_class_id']) : 0), 2);
                $amount += round(($price + $vat) * $product['quantity'], 2);
                $amounttax += round($vat * $product['quantity'], 2);
            }
            //$amounttax = round($amounttax - ($amounttax / 100 * $discount), 2);
            $total = round($amount, 2);
            //$total = round($subtotal - ($subtotal / 100 * $discount), 2);
            //$discount = $total - $subtotal;
        } else {
            $total = $subtotal;
        }

        $shipping = isset($this->session->data['shipping_method']['cost']) ? $this->session->data['shipping_method']['cost'] : 30;
        if ($total > 1500) {
            $shipping = 0;
        } else {
            $shipping = isset($this->session->data['shipping_method']['cost']) ? $this->session->data['shipping_method']['cost'] : 0;
            $total += $shipping;
        }
        if ($total > 1500) $shipping = 0;
        else $total += $shipping;

        $data = [
            'subtotal' => $this->currency->format($subtotal, $this->session->data['currency']),
            'discount' => $discount . " %",
            'price'    => $price + $vat,
            'shipping' => $this->currency->format($shipping, $this->session->data['currency']),
            'tax'      => $this->currency->format($amounttax, $this->session->data['currency']),
            'total'    => $this->currency->format($total, $this->session->data['currency'])
        ];
        if ($json) {
            $this->sendJSON($data);
        }
        return $data;
    }

    public function order()
    {
        // Запоминаем данные формы
        $address = $this->request->post['address'];
        $products = $this->request->post['product'];

        // 1) Собираем все ошибки
        $error = $this->validateAddress($address, $products);
        if (!$error) {
            // проверка на количество
            if (empty($products) || !array_filter($products, fn($p)=>!empty($p['quantity']))) {
                $error['general'] = $this->language->get('error_empty_products');
            }
        }

        if ($error) {
            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 400 Bad Request');
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode(['error' => $error]));
            return;
        }

        $this->session->data['wholesale_address'] = $address;

        // Проверяем корректность заполненных данных
        $error = $this->validateAddress($address, $products);
        if ($error) {
            $this->sendJSON(['error' => $error]);
        }

        $this->load->language('checkout/buy');
        $this->load->model('localisation/country');
        $this->load->model('checkout/order');
        $this->load->model('catalog/product');

        // Данные заказа
        $order_data = [];
        $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
        $order_data['store_id'] = $this->config->get('config_store_id');
        $order_data['store_name'] = $this->config->get('config_name');

        if ($order_data['store_id']) {
            $order_data['store_url'] = $this->config->get('config_url');
        } else {
            $order_data['store_url'] = ($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER;
        }

        $order_data['customer_id'] = $this->customer->getId();
        $order_data['customer_group_id'] = $this->customer->getGroupId();
        $order_data['firstname'] = $address['firstname'];
        $order_data['lastname'] = $address['lastname'];
        $order_data['email'] = $address['email'];
        $order_data['telephone'] = $address['telephone'];
        $order_data['comment'] = $address['comment'];

        // Получаем custom_field из аккаунта покупателя
        $this->load->model('account/customer');
        $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
        $order_data['custom_field'] = json_decode($customer_info['custom_field'], true);
        $order_data['custom_field'][1] = $address['company'];
        $order_data['custom_field'][3] = $address['nip'];
        $order_data['custom_field'][6] = $address['city'];
        $order_data['custom_field'][7] = $address['postcode'];
        $order_data['custom_field'][4] = $address['address_1'];
        $client_info = $address;
        $client_info['custom_field']['account'][1] = $address['company'];
        $client_info['custom_field']['account'][3] = $address['nip'];
        $client_info['custom_field']['account'][4] = $address['address_1'];
        $client_info['custom_field']['account'][6] = $address['city'];
        $client_info['custom_field']['account'][7] = $address['postcode'];
        $this->model_account_customer->editCustomer($this->customer->getId(),  $client_info);
        $order_data['payment_company'] = $order_data['custom_field'][1];
        $order_data['payment_firstname'] = $order_data['firstname'];
        $order_data['payment_lastname'] = $order_data['lastname'];
        $order_data['payment_address_1'] = $address['address_1'];
        $order_data['payment_address_2'] = '';
        $order_data['payment_city'] = $order_data['custom_field'][6];
        $order_data['payment_postcode'] = $order_data['custom_field'][7];
        $order_data['payment_zone'] = '';
        $order_data['payment_zone_id'] = 0;
        $order_data['payment_country'] = '';
        $order_data['payment_country_id'] = $this->config->get('config_country_id');
        $order_data['payment_address_format'] = '';
        $order_data['payment_custom_field'] = $order_data['custom_field'];

        // Дублируем в shipping_* те же данные
        $order_data['shipping_firstname'] = $order_data['payment_firstname'];
        $order_data['shipping_lastname'] = $order_data['payment_lastname'];
        $order_data['shipping_company'] = $order_data['payment_company'];
        $order_data['shipping_address_1'] = $order_data['payment_address_1'];
        $order_data['shipping_address_2'] = $order_data['payment_address_2'];
        $order_data['shipping_city'] = $order_data['payment_city'];
        $order_data['shipping_postcode'] = $order_data['payment_postcode'];
        $order_data['shipping_zone'] = $order_data['payment_zone'];
        $order_data['shipping_zone_id'] = $order_data['payment_zone_id'];
        $order_data['shipping_country'] = $order_data['payment_country'];
        $order_data['shipping_country_id'] = $order_data['payment_country_id'];
        $order_data['shipping_address_format'] = $order_data['payment_address_format'];
        $order_data['shipping_custom_field'] = $order_data['payment_custom_field'];

        // Метод оплаты
        if (isset($this->session->data['payment_method']['title'])) {
            $order_data['payment_method'] = $this->session->data['payment_method']['title'];
        } else {
            $order_data['payment_method'] = '';
        }
        if (isset($this->session->data['payment_method']['code'])) {
            $order_data['payment_code'] = $this->session->data['payment_method']['code'];
        } else {
            $order_data['payment_code'] = '';
        }

        // Считаем товары
        $primary_discount = $this->config->get('module_nr_wholesale_discount');
        $amount = 0;
        $amounttax = 0;
        $order_data['products'] = [];

        foreach ($products as $product) {
            if (!$product['quantity']) continue;
            $product_info = $this->model_catalog_product->getProduct($product['product_id']);

            $price = round($product_info['price'] - ($product_info['price'] / 100 * $primary_discount), 2);
            $tax = round($this->tax->getTax($price, $product_info['tax_class_id']), 2);

            $amount += round(($price + $tax) * $product['quantity'], 2);
            $amounttax += round($tax * $product['quantity'], 2);

            $order_data['products'][] = [
                'product_id' => $product['product_id'],
                'name'       => $product_info['name'],
                'model'      => $product_info['model'],
                'option'     => [],
                'download'   => [],
                'quantity'   => $product['quantity'],
                'subtract'   => $product_info['subtract'],
                'price'      => $price,
                'total'      => $price * $product['quantity'],
                'tax'        => $tax,
                'reward'     => 0,
                'image'      => ($product_info['image'] ? $product_info['image'] : ''),
                'sku'        => $product_info['sku'],
                'weight'     => $product_info['weight'],
            ];
        }

        // Изначальная сумма
        $subtotal = round($amount, 2);

        // Определяем скидку по сумме
        if ($subtotal >= $this->config->get('module_nr_wholesale_sum3')) {
            $discount = $this->config->get('module_nr_wholesale_discount3');
        } elseif ($subtotal >= $this->config->get('module_nr_wholesale_sum2')) {
            $discount = $this->config->get('module_nr_wholesale_discount2');
        } elseif ($subtotal >= $this->config->get('module_nr_wholesale_sum1')) {
            $discount = $this->config->get('module_nr_wholesale_discount1');
        } else {
            $discount = 0;
        }

        // Применяем скидку
        if ($discount > 0) {
            $amount = 0;
            $amounttax = 0;
            foreach ($order_data['products'] as &$p) {
                $p['price'] = round($p['price'] - ($p['price'] / 100 * $discount), 2);
                $p['total'] = round($p['price'] * $p['quantity'], 2);
                $p['tax']   = round($this->tax->getTax($p['price'], $product_info['tax_class_id']), 2);

                $amount += round(($p['price'] + $p['tax']) * $p['quantity'], 2);
                $amounttax += round($p['tax'] * $p['quantity'], 2);
            }
            $total = round($amount, 2);
        } else {
            $total = $subtotal;
        }
        $totaldiscount = $subtotal - $total;

        // Получаем реальные данные доставки из сессии
        if (!empty($this->session->data['shipping_method']['cost'])) {
            $shipping = $this->session->data['shipping_method']['cost'];
        } else {
            $shipping = 0;
        }
        if (!empty($this->session->data['shipping_method']['title'])) {
            $order_data['shipping_method'] = $this->session->data['shipping_method']['title'];
        } else {
            $order_data['shipping_method'] = 'Metoda dostawy';
        }
        if (!empty($this->session->data['shipping_method']['code'])) {
            $order_data['shipping_code'] = $this->session->data['shipping_method']['code'];
        } else {
            $order_data['shipping_code'] = '';
        }

        // Если больше 1500 - доставка 0
        if ($total > 1500) {
            $shipping = 0;
        } else {
            $total += $shipping;
        }

        // Формируем итоги
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
                'value'      => $totaldiscount,
                'sort_order' => 2
            ],
            [
                'code'       => 'shipping',
                'title'      => $order_data['shipping_method'],
                'value'      => $shipping,
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

        // Прочие поля
        $order_data['affiliate_id'] = 0;
        $order_data['commission']   = 0;
        $order_data['marketing_id'] = 0;
        $order_data['tracking']     = '';
        $order_data['language_id']  = $this->config->get('config_language_id');
        $order_data['currency_id']  = $this->currency->getId($this->session->data['currency']);
        $order_data['currency_code'] = $this->session->data['currency'];
        $order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
        $order_data['ip'] = $this->request->server['REMOTE_ADDR'];

        if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
            $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
        } else {
            $order_data['forwarded_ip'] = '';
        }
        $order_data['user_agent']      = isset($this->request->server['HTTP_USER_AGENT']) ? $this->request->server['HTTP_USER_AGENT'] : '';
        $order_data['accept_language'] = isset($this->request->server['HTTP_ACCEPT_LANGUAGE']) ? $this->request->server['HTTP_ACCEPT_LANGUAGE'] : '';

        // Создаём заказ
        $order_id = $this->model_checkout_order->addOrder($order_data);
        $this->session->data['order_id'] = $order_id;

        // Присваиваем статус заказа
        if ($order_data['payment_code']) {
            $status = $this->config->get('payment_' . $order_data['payment_code'] . '_order_status_id');
        } else {
            $status = $this->config->get('config_order_status_id');
        }
        $this->model_checkout_order->addOrderHistory($order_id, $status);

        // Вызываем контроллер оплаты
        $payment = $this->load->controller('extension/payment/' . $this->session->data['payment_method']['code']);

        // Очищаем wholesale_products
        unset($this->session->data['wholesale_products']);

        // Возвращаем ответ
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
        if ((utf8_strlen(trim($address['nip'])) < 1) || (utf8_strlen(trim($address['nip'])) > 10)|| !preg_match('/^[0-9]+$/',trim($address['nip'])))
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
