<?php
class ControllerProductRelated extends Controller
{
    public function index()
    {
        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        $product_id = isset($this->request->get['product_id']) ? (int)$this->request->get['product_id'] : 0;
        $related_products = array();

        if ($product_id) {
            $results = $this->model_catalog_product->getProductRelated($product_id);

            foreach ($results as $result) {
                // Получаем полные данные товара через getProduct()
                $product = $this->model_catalog_product->getProduct($result['product_id']);
                if ($product) {
                    $related_products[] = array(
                        'product_id' => $product['product_id'],
                        'name'       => $product['name'],
                        'thumb'      => $product['image'],
                        'old_price'  => $this->currency->format($this->tax->calculate($product['old_price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']),
                        'price'      => $this->currency->format(
                            $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')),
                            $this->session->data['currency']
                        ),
                        'href'       => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                    );
                }
            }
        }

        // Если найдено меньше 20 товаров, дополняем случайными
        if (count($related_products) < 20) {
            $needed = 20 - count($related_products);
            $all_products = $this->model_catalog_product->getProducts(array());
            $existing_ids = array();
            foreach ($related_products as $rp) {
                $existing_ids[] = $rp['product_id'];
            }
            $existing_ids[] = $product_id;
            $additional = array();

            foreach ($all_products as $p) {
                if (!in_array($p['product_id'], $existing_ids)) {
                    // Получаем актуальные данные товара
                    $product = $this->model_catalog_product->getProduct($p['product_id']);
                    if ($product) {
                        $additional[] = array(
                            'product_id' => $product['product_id'],
                            'name'       => $product['name'],
                            'old_price'  => $this->currency->format($this->tax->calculate($product['old_price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']),
                            'thumb'      => $product['image'],
                            'price'      => $this->currency->format(
                                $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')),
                                $this->session->data['currency']
                            ),
                            'href'       => $this->url->link('product/product', 'product_id=' . $product['product_id'])
                        );
                    }
                }
            }

            $additional = array_slice($additional, 0, $needed);
            $related_products = array_merge($related_products, $additional);
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode(array('related_products' => $related_products)));
    }
}
