<?php
class ControllerAccountLogin extends Controller
{
	private $error = array();

	public function index()
	{
		if ($this->customer->isLogged()) {
			$this->response->redirect('/konto');
		}

		$this->load->language('account/login');
		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->customer->login($this->request->post['email'], $this->request->post['password'])) {
				$this->session->data['customer_id'] = $this->customer->getId();
				$this->response->redirect('/hurtownia');
			} else {
				$data['error_warning'] = $this->language->get('error_login');
			}
		}

		$data['action'] = $this->url->link('account/login');
		$data['register'] = $this->url->link('account/register');
		$data['forgotten'] = $this->url->link('account/forgotten');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('account/login', $data));
	}

	protected function validate()
	{
		// Check how many login attempts have been made.
		$login_info = $this->model_account_customer->getLoginAttempts($this->request->post['email']);

		if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
			$this->error['warning'] = $this->language->get('error_attempts');
		}

		// Check if customer has been approved.
		$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

		if ($customer_info && !$customer_info['status']) {
			$this->error['warning'] = $this->language->get('error_approved');
		}

		if (!$this->error) {
			if (!$this->customer->login($this->request->post['email'], $this->request->post['password'])) {
				$this->error['warning'] = $this->language->get('error_login');

				$this->model_account_customer->addLoginAttempt($this->request->post['email']);
			} else {
				$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
			}
		}

		return !$this->error;
	}
}
