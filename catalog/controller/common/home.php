<?php
class ControllerCommonHome extends Controller
{
	public function index()
	{
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$data['carousel'] = $this->load->view('common/carousel');
		$data['promotion'] = $this->load->view('common/promotion');
		$data['categories_list'] = $this->load->view('common/categories_list');
		$data['product'] = $this->load->view('product/product');


		$this->document->breadcrumbs = [
			[
				'text' => 'Главная страница',
				'href' => $this->url->link('common/home')
			]
		];
		
		$products = $this->model_catalog_product->getProducts([
			'sort' => 'p.viewed',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 4
		]);
		
		$this->document->itemList = [];
		
		foreach ($products as $product) {
			$this->document->itemList[] = $this->url->link('product/product', 'product_id=' . $product['product_id']);
		}
		

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
