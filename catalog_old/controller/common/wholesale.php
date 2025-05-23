<?php

class ControllerCommonWholesale extends Controller
{
    public function index()
    {
        if (!$this->customer->isLogged()) {
            $this->response->redirect($this->url->link('account/register'));
            return;
        }

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        $this->load->model('extension/total/coupon'); // Загружаем модель купонов

        $coupon_code = '2222'; // Задаем код купона (можно передавать через GET/POST)
        $coupon_info = $this->model_extension_total_coupon->getCoupon($coupon_code);
        $categories = $this->model_catalog_category->getCategories();
        $data['category_products'] = [];

        $this->load->model('setting/extension');
        $this->load->model('account/address');

        // Получаем адрес пользователя (если он авторизован)
        if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
            $address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
        } else {
            $address = [
                'country_id' => $this->config->get('config_country_id'),
                'zone_id' =>  $this->config->get('config_zone_id')
            ];
        }

        $payment_methods = [];
        $extensions = $this->model_setting_extension->getExtensions('payment');

        foreach ($extensions as $extension) {
            if ($this->config->get('payment_' . $extension['code'] . '_status')) {
                $this->load->model('extension/payment/' . $extension['code']);
                $method = $this->{'model_extension_payment_' . $extension['code']}->getMethod($address, 0);

                if ($method) {
                    $payment_methods[] = $method;
                }
            }
        }

        $data['payment_methods'] = $payment_methods;

        foreach ($categories as $category) {
            $filter_data = [
                'filter_category_id' => $category['category_id'],
                'start' => 0,
                'limit' => 0
            ];

            $products = $this->model_catalog_product->getProducts($filter_data);
            $data['product_currency'] = $this->currency->getSymbolLeft($this->config->get('config_currency')) ?: $this->currency->getSymbolRight($this->config->get('config_currency'));

            if ($products) {
                $data['category_products'][] = [
                    'category_name' => $category['name'],
                    'products'      => $this->prepareProductData($products, $coupon_info)
                ];
            }
        }

        $data['breadcrumbs'] = [
            [
                'text' => 'Główna',
                'href' => $this->url->link('common/home')
            ],
            [
                'text' => 'Hurtownia',
                'href' => $this->url->link('common/workwithus')
            ]
        ];

        $this->response->setOutput($this->load->view('common/wholesale', $data));
    }

    private function prepareProductData($products, $coupon_info)
    {
        $product_data = [];
        foreach ($products as $product) {
            $attributes = $this->model_catalog_product->getProductAttributes($product['product_id']);
            $quantity_per_pack = '';

            foreach ($attributes as $attribute_group) {
                foreach ($attribute_group['attribute'] as $attribute) {
                    if ($attribute['name'] == 'quantity_per_pack') {
                        $quantity_per_pack = $attribute['text'];
                    }
                }
            }

            if ($quantity_per_pack) {
                $tax_class_id = $product['tax_class_id'];
                $price_with_tax = $this->tax->calculate($product['price'], $tax_class_id, $this->config->get('config_tax'));

                // Применяем купон
                $discount_amount = $this->applyCouponDiscount($price_with_tax, $coupon_info);
                $final_price = $price_with_tax - $discount_amount;

                $product_data[] = [
                    'currency_symbol' 	=> $this->currency->getSymbolLeft($this->config->get('config_currency')) ?: $this->currency->getSymbolRight($this->config->get('config_currency')),
                    'product_id'        => $product['product_id'],
                    'name'              => $product['name'],
                    'image' => HTTP_SERVER . 'image/' . $product['image'],
                    'quantity_per_pack' => $quantity_per_pack,
                    'price' 		    => number_format($product['price'], 2, '.', ''),
                    'price_with_tax'    => number_format($price_with_tax, 2, '.', ''),
                    'price_per_pack' 	=> number_format($quantity_per_pack * $final_price, 2, '.', ''),
                    'final_price'       => number_format($final_price, 2, '.', ''),
                    'discount_amount'   => number_format($discount_amount, 2, '.', ''),
                    'coupon_code'       => $coupon_info ? $coupon_info['code'] : '',
                    'href'              => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                ];
            }
        }
        return $product_data;
    }

    private function applyCouponDiscount($price, $coupon_info)
    {
        if (!$coupon_info) {
            return 0; // Если купон не найден, скидки нет
        }

        if ($coupon_info['type'] == 'P') { // Процентная скидка
            return ($price * $coupon_info['discount']) / 100;
        } elseif ($coupon_info['type'] == 'F') { // Фиксированная сумма
            return min($coupon_info['discount'], $price);
        }

        return 0;
    }
}
