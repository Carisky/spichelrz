<?php
class ControllerCommonShop extends Controller {
    public function index(): void {
        


        
        $data['breadcrumbs'] = [
            [
                'text' => 'Główna',
                'href' => $this->url->link('common/home')
            ],
            [
                'text' => 'Sklep',
                'href' => $this->url->link('common/shop')
            ]
        ];

        
        $filter = isset($this->request->get['filter']) ? $this->request->get['filter'] : '';
        $sort   = isset($this->request->get['sort']) ? $this->request->get['sort'] : 'p.sort_order';
        $order  = isset($this->request->get['order']) ? $this->request->get['order'] : 'ASC';
        $page   = isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1;
        if (isset($this->request->get['limit']) && (int)$this->request->get['limit'] > 0) {
            $limit = (int)$this->request->get['limit'];
        } else {
            $limit = $this->config->get('theme_' . $this->config->get('config_theme') . '_product_limit');
        }

        
        $this->load->model('catalog/category');
        $shop_categories = [];
        $categories = $this->model_catalog_category->getCategories(0);
        foreach ($categories as $category) {
            $shop_categories[] = [
                'name' => $category['name'],
                
                'href' => $this->url->link('product/category', 'path=' . $category['category_id'])
            ];
        }
        $data['shop_categories'] = $shop_categories;

        
        $url = '';
        if (isset($this->request->get['filter'])) {
            $url .= '&filter=' . $this->request->get['filter'];
        }
        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }

        
        $data['sorts'] = [];
        $data['sorts'][] = [
            'text'  => 'Domyślnie',
            'value' => 'p.sort_order-ASC',
            'href'  => $this->url->link('common/shop', 'sort=p.sort_order&order=ASC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Nazwa (A - Z)',
            'value' => 'pd.name-ASC',
            'href'  => $this->url->link('common/shop', 'sort=pd.name&order=ASC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Nazwa (Z - A)',
            'value' => 'pd.name-DESC',
            'href'  => $this->url->link('common/shop', 'sort=pd.name&order=DESC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Cena (od najniższej)',
            'value' => 'p.price-ASC',
            'href'  => $this->url->link('common/shop', 'sort=p.price&order=ASC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Cena (od najwyższej)',
            'value' => 'p.price-DESC',
            'href'  => $this->url->link('common/shop', 'sort=p.price&order=DESC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Ocena (od najwyższej)',
            'value' => 'rating-DESC',
            'href'  => $this->url->link('common/shop', 'sort=rating&order=DESC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Ocena (od najniższej)',
            'value' => 'rating-ASC',
            'href'  => $this->url->link('common/shop', 'sort=rating&order=ASC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Model (rosnąco)',
            'value' => 'p.model-ASC',
            'href'  => $this->url->link('common/shop', 'sort=p.model&order=ASC' . $url)
        ];
        $data['sorts'][] = [
            'text'  => 'Model (malejąco)',
            'value' => 'p.model-DESC',
            'href'  => $this->url->link('common/shop', 'sort=p.model&order=DESC' . $url)
        ];

        
        $data['sort']  = $sort;
        $data['order'] = $order;
        $data['page']  = $page;
        $data['limit'] = $limit;

        
        
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        
        
        $results = $this->model_catalog_product->getProducts([
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $limit,
            'limit' => $limit
        ]);
        
        $data['products'] = [];
        
        $itemList = [];
        
        foreach ($results as $result) {
            $href = $this->url->link('product/product', 'product_id=' . $result['product_id']);
        
            $data['products'][] = [
                'product_id' => $result['product_id'],
                'name'       => $result['name'],
                'href'       => $href

            ];
        
            $itemList[] = $href;
        }
        

        $this->document->itemList = $itemList;

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $this->response->setOutput($this->load->view('common/shop', $data));
    }
}
