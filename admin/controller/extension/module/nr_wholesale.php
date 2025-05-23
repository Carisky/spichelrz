<?php
class ControllerExtensionModuleNrWholesale extends Controller {
	public function index() 
	{
		$this->load->language('extension/module/nr_wholesale');
		$data['action'] = $this->url->link('extension/module/nr_wholesale', 'user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('setting/setting');
			$this->model_setting_setting->editSetting('module_nr_wholesale', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($data['cancel']);
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/nr_wholesale', 'user_token=' . $this->session->data['user_token'], true)
		);
		
		if (isset($this->request->post['module_nr_wholesale_status'])) {
			$data['module_nr_wholesale_status'] = $this->request->post['module_nr_wholesale_status'];
		} else {
			$data['module_nr_wholesale_status'] = $this->config->get('module_nr_wholesale_status');
		}
		if (isset($this->request->post['module_nr_wholesale_discount'])) {
			$data['module_nr_wholesale_discount'] = $this->request->post['module_nr_wholesale_discount'];
		} else {
			$data['module_nr_wholesale_discount'] = $this->config->get('module_nr_wholesale_discount');
		}
		if (isset($this->request->post['module_nr_wholesale_sum1'])) {
			$data['module_nr_wholesale_sum1'] = $this->request->post['module_nr_wholesale_sum1'];
		} else {
			$data['module_nr_wholesale_sum1'] = $this->config->get('module_nr_wholesale_sum1');
		}
		if (isset($this->request->post['module_nr_wholesale_discount1'])) {
			$data['module_nr_wholesale_discount1'] = $this->request->post['module_nr_wholesale_discount1'];
		} else {
			$data['module_nr_wholesale_discount1'] = $this->config->get('module_nr_wholesale_discount1');
		}
		if (isset($this->request->post['module_nr_wholesale_sum2'])) {
			$data['module_nr_wholesale_sum2'] = $this->request->post['module_nr_wholesale_sum2'];
		} else {
			$data['module_nr_wholesale_sum2'] = $this->config->get('module_nr_wholesale_sum2');
		}
		if (isset($this->request->post['module_nr_wholesale_discount2'])) {
			$data['module_nr_wholesale_discount2'] = $this->request->post['module_nr_wholesale_discount2'];
		} else {
			$data['module_nr_wholesale_discount2'] = $this->config->get('module_nr_wholesale_discount2');
		}
		if (isset($this->request->post['module_nr_wholesale_sum3'])) {
			$data['module_nr_wholesale_sum3'] = $this->request->post['module_nr_wholesale_sum3'];
		} else {
			$data['module_nr_wholesale_sum3'] = $this->config->get('module_nr_wholesale_sum3');
		}
		if (isset($this->request->post['module_nr_wholesale_discount3'])) {
			$data['module_nr_wholesale_discount3'] = $this->request->post['module_nr_wholesale_discount3'];
		} else {
			$data['module_nr_wholesale_discount3'] = $this->config->get('module_nr_wholesale_discount3');
		}



		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/nr_wholesale', $data));
		
	}
}