<?php
class ControllerProductAll extends Controller {
    public function index(){
        $this->load->model('catalog/product');
        $this->load->model('catalog/category'); // Загрузка модели категорий

        $products = $this->model_catalog_product->getProducts();

        // Формирование ответа
        $product_data = [];
        foreach ($products as $product) {
            // Получаем категории товара

            $categories = $this->model_catalog_product->getCategories($product['product_id']);
            $category_names = [];
            foreach ($categories as $category) {
                $category_info = $this->model_catalog_category->getCategory($category['category_id']);
                if ($category_info) {
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'category_id=" . $this->db->escape($category_info['category_id']) . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");
				    if ($query->num_rows) $category_names[] = $query->row['keyword'];
                }
            }

            // ✅ Налоговый класс товара
            //$tax_class_id = $product['tax_class_id'];
            
            // ✅ Расчет цены с учетом налога
            // $price_with_tax = $this->tax->calculate($product['price'], $tax_class_id, $this->config->get('config_tax'));
            // $formatted_price = $this->currency->format($price_with_tax, $this->session->data['currency']);
            $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

            // ✅ Определение процентной ставки налога
            $tax_rates = $this->tax->getRates($product['price'], $product['tax_class_id']);
            $tax_percentage = 0;
            foreach ($tax_rates as $tax) {
                if ($tax['type'] === 'P') { // Проверяем, что налог процентный
                    $tax_percentage = $tax['rate'];
                    break;
                }
            }

            $product_data[] = [
                'product_id'  => $product['product_id'],
                'name'        => $product['name'],
                'old_price'   => $product['old_price'],  // Цена с налогом
                'price'       => $price,  // Цена с налогом
                'image_url'   => $product['image'],
                'rating'      => $product['rating'],
                'categories'  => $category_names, // Категории
                'tax_rate'    => $tax_percentage, // Процент налога
                'href'        => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                'old_price'   => $this->currency->format($this->tax->calculate($product['old_price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
            ];
        }

        // Ответ в формате JSON
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode([
            'products' => $product_data,
        ]));
    }
}
