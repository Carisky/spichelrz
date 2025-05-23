<?php
class ControllerExtensionModuleNrProducts extends Controller {
	public function index() 
	{
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$width = $this->config->get('theme_default_image_popup_width');
		$height = $this->config->get('theme_default_image_popup_height');
		
		$products = $this->config->get('module_nr_products_products');
		$data['products'] = array();
		if(!empty($products)) {
			$this->load->model('catalog/product');
			$this->load->model('tool/image');
			
			$data['products'] = array();
			foreach($products as $product) {
				$info = $this->model_catalog_product->getProduct($product['product_id']);
				$image = empty($info['image']) ? 'placeholder.png' : $info['image'];
				$price = empty($info['special']) ? $info['price'] : $info['special'];
				
				$data['products'][$product['sort_order']] = [
					'product_id' => $info['product_id'],
					'name' => $info['name'],
					'description' => html_entity_decode($product['desc']),
					'href' => $this->url->link('product/product', 'product_id=' . $info['product_id']),
					'image' => $this->model_tool_image->resize($image, $width, $height),
					'price' => $this->currency->format($this->tax->calculate($price, $info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']),
					'color' => $product['color']
				];
			}
		}
		
		return $this->load->view('extension/module/nr_products', $data);
	}
	
}