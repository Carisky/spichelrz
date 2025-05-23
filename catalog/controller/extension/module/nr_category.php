<?php
class ControllerExtensionModuleNrCategory extends Controller {
	public function index() {
		$this->load->language('extension/module/nr_category');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);
		
		$this->load->model('tool/image');
		$width = $this->config->get('theme_default_image_category_width');
		$height = $this->config->get('theme_default_image_category_height');
		
		foreach ($categories as $category) {
			if(!in_array($category['category_id'], $this->config->get('module_nr_category_categories'))) continue;
				
			$data['categories'][] = [
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id']),
				'image' => ($category['image'] ? $this->model_tool_image->resize($category['image'], $width, $height) : '')
			];
		}

		return $this->load->view('extension/module/nr_category', $data);
	}
}