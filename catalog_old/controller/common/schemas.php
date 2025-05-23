<?php
class ControllerCommonSchemas extends Controller {
	public function index() {
		$schemas = [];

		$base_url = ($this->request->server['HTTPS'] ? $this->config->get('config_ssl') : $this->config->get('config_url'));

		// Organization
		$org = [
			'@context' => 'http://schema.org',
			'@type'    => 'Organization',
			'name'     => $this->config->get('config_meta_title') ?: $this->config->get('config_name'),
			'url'      => $base_url,
			'logo'     => $base_url . 'image/' . $this->config->get('config_logo'),
			'contactPoint' => [
				[
					'@type' => 'ContactPoint',
					'telephone' => $this->config->get('config_telephone'),
					'contactType' => 'customer service'
				]
			]
		];

		$schemas[] = $org;

		// BreadcrumbList (если есть)
		if (!empty($this->document->breadcrumbs)) {
			$breadcrumbSchema = [
				'@context' => 'http://schema.org',
				'@type' => 'BreadcrumbList',
				'itemListElement' => []
			];

			$position = 1;
			foreach ($this->document->breadcrumbs as $breadcrumb) {
				$breadcrumbSchema['itemListElement'][] = [
					'@type' => 'ListItem',
					'position' => $position++,
					'item' => [
						'@id' => $breadcrumb['href'],
						'name' => $breadcrumb['text']
					]
				];
			}

			$schemas[] = $breadcrumbSchema;
		}

		// ItemList (только если есть список продуктов)
		if (!empty($this->document->itemList)) {
			$itemListSchema = [
				'@context' => 'http://schema.org',
				'@type' => 'ItemList',
				'itemListElement' => []
			];

			$pos = 1;
			foreach ($this->document->itemList as $item) {
				$itemListSchema['itemListElement'][] = [
					'@type' => 'ListItem',
					'position' => $pos++,
					'url' => $item
				];
			}

			$schemas[] = $itemListSchema;
		}

		$store = [
			'@context' => 'http://schema.org',
			'@type'    => 'Store',
			'name'     => $this->config->get('config_meta_title') ?: $this->config->get('config_name'),
			'url'      => $base_url,
			'image'    => $base_url . 'image/' . $this->config->get('config_logo'),
			'telephone' => array_filter([
				$this->config->get('config_telephone'),
				$this->config->get('config_telephone_2')
			]),
			'priceRange' => $this->config->get('config_price_range'),
			'sameAs' => array_filter([
				$this->config->get('config_social_facebook'),
				$this->config->get('config_social_youtube')
			]),
			'openingHoursSpecification' => [[
				'@type' => 'OpeningHoursSpecification',
				'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
				'opens' => $this->config->get('config_opening_hours_open'),
				'closes' => $this->config->get('config_opening_hours_close')
			]],
			'address' => [
				'@type' => 'PostalAddress',
				'streetAddress' => $this->config->get('config_address_street'),
				'addressLocality' => $this->config->get('config_address_city'),
				'addressCountry' => [
					'@type' => 'Country',
					'name' => $this->config->get('config_address_country')
				]
			]
		];
		
		$schemas[] = $store;
		

		$data['schemas_org'] = $schemas;

		return $this->load->view('common/schemas', $data);
	}
}
