<?php
class ControllerCommonSingleProduct extends Controller
{
    public function index()
    {
        $this->load->language('product/product');

        // Получаем ID продукта из URL
        $product_id = isset($this->request->get['id']) ? (int)$this->request->get['id'] : 0;

        // Загружаем модель, которая будет работать с продуктами
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');

        // Получаем информацию о продукте
        $product_info = $this->model_catalog_product->getProduct($product_id);

        if (!$product_info) {
            $this->response->redirect($this->url->link('error/not_found'));
            return;
        }

        // Загружаем данные о продукте
        $data['name'] = $product_info['name'];
        $data['price'] = $this->currency->format($product_info['price'], $this->session->data['currency']);
        $data['image_url'] = $product_info['image'] ? 'image/' . $product_info['image'] : 'image/catalog/assets/placeholder.png';
        $data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
        $data['rating'] = (int)$product_info['rating'];
        $data['quantity'] = (int)$product_info['quantity'];
        $data['sku'] = $product_info['sku'];
        $data['id'] = $product_info['product_id'];

        // Генерация звезд рейтинга
        $data['stars'] = '';
        for ($i = 0; $i < 5; $i++) {
            $data['stars'] .= ($i < $data['rating']) 
                ? '<svg width="13" height="12" viewbox="0 0 13 12" fill="#987253" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 0.618034L7.59607 3.99139C7.72994 4.40341 8.1139 4.68237 8.54713 4.68237H12.0941L9.22453 6.76722C8.87405 7.02186 8.72739 7.47323 8.86126 7.88526L9.95733 11.2586L7.08779 9.17376C6.7373 8.91912 6.2627 8.91912 5.91221 9.17376L3.04267 11.2586L4.13874 7.88525C4.27261 7.47323 4.12595 7.02186 3.77547 6.76722L0.905918 4.68237H4.45287C4.8861 4.68237 5.27006 4.40341 5.40393 3.99139L6.5 0.618034Z" stroke="#C7A992"/></svg>'
                : '<svg width="13" height="12" viewbox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 0.618034L7.59607 3.99139C7.72994 4.40341 8.1139 4.68237 8.54713 4.68237H12.0941L9.22453 6.76722C8.87405 7.02186 8.72739 7.47323 8.86126 7.88526L9.95733 11.2586L7.08779 9.17376C6.7373 8.91912 6.2627 8.91912 5.91221 9.17376L3.04267 11.2586L4.13874 7.88525C4.27261 7.47323 4.12595 7.02186 3.77547 6.76722L0.905918 4.68237H4.45287C4.8861 4.68237 5.27006 4.40341 5.40393 3.99139L6.5 0.618034Z" stroke="#C7A992"/></svg>';
        }

        // Получаем категорию продукта
        $categories = $this->model_catalog_product->getCategories($product_id);
        if (!empty($categories)) {
            $category_info = $this->model_catalog_category->getCategory($categories[0]['category_id']);
            $data['category'] = $category_info ? $category_info['name'] : '';
        } else {
            $data['category'] = '';
        }

        // Хлебные крошки
        $data['breadcrumbs'] = [
            [
                'text' => 'Strona Główna',
                'href' => $this->url->link('common/home')
            ]
        ];

        if (!empty($data['category'])) {
            $data['breadcrumbs'][] = [
                'text' => $data['category'],
                'href' => $this->url->link('product/category', 'path=' . $categories[0]['category_id'])
            ];
        }
        
        

        $data['breadcrumbs'][] = [
            'text' => $data['name']
        ];

        // Подключаем header, footer и прочее
        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');

        // Выводим шаблон singleproduct.tpl
        $this->response->setOutput($this->load->view('common/singleproduct', $data));
    }
}
