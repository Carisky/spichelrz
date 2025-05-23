<?php
class ControllerCheckoutCart extends Controller
{
	public function index()
	{
		$this->load->language('checkout/cart');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/cart')
		];

		if ($this->cart->hasProducts() || !empty($this->session->data['vouchers'])) {
			$data['error_warning'] = isset($this->session->data['error']) ? $this->session->data['error'] : '';

			unset($this->session->data['error']);

			$data['attention'] = ($this->config->get('config_customer_price') && !$this->customer->isLogged()) ? sprintf($this->language->get('text_login'), $this->url->link('account/login'), $this->url->link('account/register')) : '';

			$data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
			unset($this->session->data['success']);

			$data['weight'] = $this->config->get('config_cart_weight') ? $this->weight->format($this->cart->getWeight(), $this->config->get('config_weight_class_id')) : '';

			$data['list'] = $this->getList();

			$this->load->model('setting/extension');

			$data['modules'] = [];

			$extensions = $this->model_setting_extension->getExtensions('total');

			foreach ($extensions as $extension) {
				$result = $this->load->controller('extension/total/' . $extension['code']);

				if ($result) {
					$data['modules'][] = $result;
				}
			}

			$data['continue'] = $this->url->link('common/home');
			$data['checkout'] = $this->url->link('checkout/checkout');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('checkout/cart', $data));
		} else {
			$data['text_error'] = $this->language->get('text_no_results');

			$data['continue'] = $this->url->link('common/home');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function getList()
	{
		$data['product_edit'] = $this->url->link('checkout/cart/edit');
		$data['product_remove'] = $this->url->link('checkout/cart/remove');
		$data['voucher_remove'] = $this->url->link('checkout/voucher/remove');

		$data['products'] = [];

		$this->load->model('tool/image');

		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$data['products'][] = [
				'cart_id'      => $product['cart_id'],
				'product_id'   => $product['product_id'],
				'thumb'        => $product['image'],
				'name'         => $product['name'],
				'model'        => $product['model'],
				'quantity'     => $product['quantity'],
				'stock'        => $product['stock'],
				'price'        => $this->currency->format($product['price'], $this->session->data['currency']),
				'total'        => $this->currency->format($product['total'], $this->session->data['currency']),
				'href'         => $this->url->link('product/product', 'product_id=' . $product['product_id'])
			];
		}

		$this->response->setOutput(json_encode($data));
	}

	public function add()
	{
		$this->load->language('checkout/cart');

		$json = [];

		$product_id = isset($this->request->post['product_id']) ? (int)$this->request->post['product_id'] : 0;
		$quantity = isset($this->request->post['quantity']) ? (int)$this->request->post['quantity'] : 1;
		$option = isset($this->request->post['option']) ? array_filter($this->request->post['option']) : [];

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			$this->cart->add($product_id, $quantity, $option);

			$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $product_id), $product_info['name'], $this->url->link('checkout/cart'));

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
		} else {
			$json['error'] = $this->language->get('error_product');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function edit()
	{
		$this->load->language('checkout/cart');

		$json = [];

		$key = isset($this->request->post['key']) ? (int)$this->request->post['key'] : 0;
		$quantity = isset($this->request->post['quantity']) ? (int)$this->request->post['quantity'] : 1;

		if ($this->cart->has($key)) {
			$this->cart->update($key, $quantity);
			$json['success'] = $this->language->get('text_edit');
		} else {
			$json['error'] = $this->language->get('error_product');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function remove()
	{
		$this->load->language('checkout/cart');

		$json = [];

		$key = isset($this->request->post['key']) ? (int)$this->request->post['key'] : 0;

		if ($this->cart->has($key)) {
			$this->cart->remove($key);
			$json['success'] = $this->language->get('text_remove');
		} else {
			$json['error'] = $this->language->get('error_product');
		}

		$this->response->setOutput(json_encode($json));
	}
}
