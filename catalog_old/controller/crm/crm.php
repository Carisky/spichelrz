<?php
class ControllerCrmCrm extends Controller {
	private $setting;
	private $schema = NULL;
	
	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->load->model('setting/setting');
		$this->setting = $this->model_setting_setting->getSetting('nr_crm');
	}
	
	public function getSchema()
	{
		if(!is_null($this->schema)) return $this->schema;
		$schema = $this->config->get('nr_crm_fields_schema');
		if($schema) $this->schema = parse_ini_file(DIR_SYSTEM.'nr_crm/'.$schema.'.ini', true);
		return $this->schema;
	}
	
	public function order($order_id, $order = []) {
		$this->load->model('checkout/order');
		if(empty($order)) {
			$order = $this->model_checkout_order->getOrder($order_id);
			$order['products'] = $this->model_checkout_order->getOrderProducts($order_id);
			$order['totals'] = $this->model_checkout_order->getOrderTotals($order_id);
		}
		// $this->sendOrder($order, $totals);
	}
	
	public function cron_quantity()
	{
		$data = [
			'inventory_id' => $this->setting['nr_crm_nventory_id']
		];
		$result = $this->sendRequest('getInventoryProductsStock', $data);
		if(!is_array($result) or empty($result['products'])) exit();
		
		$this->load->model('catalog/crm');
		$this->model_catalog_crm->updateQuantity($result['products']);
		exit();
	}
	
	public function cron_price()
	{
		$data = [
			'inventory_id' => $this->setting['nr_crm_nventory_id']
		];
		$result = $this->sendRequest('getInventoryProductsPrices', $data);
		if(!is_array($result) or empty($result['products'])) exit();
		
		$this->load->model('catalog/crm');
		$this->model_catalog_crm->updatePrice($result['products']);
		exit();
	}
	
	public function sendOrder($order)
	{
		$this->getSchema();
		$this->load->model('localisation/country');
		$country = $this->model_localisation_country->getCountry($order['country_id']);
		$totals = array();
		if(!empty($order['totals'])) {
			foreach($order['totals'] as $total) {
				$totals[$total['code']] = $total['value'];
			}
		}
		$fields = $order['custom_field'] ? json_decode($order['custom_field'], true) : '';
				
		$data = [
			'order_status_id' => (int)$this->schema['default'],
			'date_add' => $order['date_added'],
			'currency' => $this->session->data['currency'],
			'payment_method' => mb_substr($order['payment_method'], 0, 30), 	
			'payment_method_cod' => 0,
			'paid' => ($order['order_status_id'] == 2 ? 1 : 0),
			'user_comments' => $order['comment'],
			'admin_comments' => '',
			'email' => $order['email'],
			'phone' => $order['telephone'],
			'user_login' => '',
			'delivery_method' => $order['shipping_method'],
			'delivery_price' => (empty($totals['shipping']) ? 0 : (float)$totals['shipping']), 
			'delivery_fullname' => 	$order['shipping_firstname'].($order['shipping_lastname'] ? ' '.$order['shipping_lastname'] : ''),
			'delivery_company' => $order['shipping_company'],
			'delivery_address' => $order['shipping_address_1'],
			'delivery_postcode' => $order['shipping_postcode'],
			'delivery_city' => $order['shipping_city'],
			'delivery_state' => ($$order['shipping_zone'] ? $order['shipping_zone'] : ''),
			'delivery_country_code' => $country['iso_code_2'], 
			'delivery_point_id' => '',
			'delivery_point_name' => '',
			'delivery_point_address' => '',
			'delivery_point_postcode' => '',
			'delivery_point_city' => '',
			'invoice_fullname' => $order['firstname'].($order['lastname'] ? ' '.$order['lastname'] : ''),
			'invoice_company' => $order['payment_company'],
			//'invoice_nip' => $order['invoice_prefix'].$order['invoice_no'],
			'invoice_address' => $order['payment_address_1'],
			'invoice_postcode' => ($order['payment_postcode'] ? $order['payment_postcode'] : ''),
			'invoice_city' => $order['payment_city'],
			'invoice_state' => ($order['payment_zone'] ? $order['payment_zone'] : ''),
			'invoice_country_code' => $order['payment_iso_code_2'],
			'invoice_nip' => (empty($fields[2]) ? '' : $fields[2]),
			'want_invoice' => 0,
			'extra_field_1' => '',
			'extra_field_2' => '',
			'custom_extra_fields' => [],
		];
		
		$products = array();
		foreach($order['products'] as $product) {
			$products[] = [
				'storage' => 'db',
				'storage_id' => 0,
				'product_id' => (int)$product['model'],
				'variant_id' => '',
				'name' => $product['name'],
				'sku' => $product['sku'],
				'ean' => $product['sku'],
				'location' => '',
				'warehouse_id' => $this->setting['nr_crm_warehouse_id'],
				'attributes' => '',
				'price_brutto' => (float)$product['price'],
				'tax_rate' => (float)$product['tax'],
				'quantity' => $product['quantity'],
				'weight' => (float)$product['weight'],
			];
		}
		
		$data['products'] = $products;

		$result = $this->sendRequest('addOrder', $data);
		
	}
	
	protected function sendRequest($method, $parameters = []) 
	{
		if (!function_exists('curl_init')) return 'cURL not exists';
		$this->load->language('crm/crm');
								
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, trim($this->setting['nr_crm_url']));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'method='.$method.'&parameters='.json_encode($parameters));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-BLToken: '.trim($this->setting['nr_crm_token'])]);
		$output = curl_exec($ch);
		curl_close($ch);
		if(!$output) return $this->language->get('error_api');
		$output = json_decode($output, true);
		if(!isset($output['status'])) return $this->language->get('error_api');
		if($output['status'] != 'SUCCESS') return $output['error_code'].': '.$output['error_message'];
		return $output;
	}
	
	
	
}