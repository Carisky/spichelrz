<?php
class ControllerAccountRegister extends Controller {
    public function index() {
        if ($this->customer->isLogged()) {
            $this->response->redirect($this->url->link('common/home'));
        }

        $this->load->language('account/register');
        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_account'),
            'href' => $this->url->link('account/account')
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_register'),
            'href' => $this->url->link('account/register')
        ];

        $data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login'));
        $data['customer_groups'] = [];

        $this->load->model('account/customer_group');
        $customer_groups = $this->model_account_customer_group->getCustomerGroups();
        foreach ($customer_groups as $customer_group) {
            $data['customer_groups'][] = $customer_group;
        }

        $data['customer_group_id'] = $this->config->get('config_customer_group_id');
        $data['register'] = $this->url->link('account/register/register');

        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('account/register', $data));
    }

    public function register() {
        $this->load->language('account/register');
        $json = [];

        $fields = ['firstname', 'lastname', 'email', 'telephone', 'password', 'customer_group_id'];

        foreach ($fields as $field) {
            if (!isset($this->request->post[$field])) {
                $this->request->post[$field] = '';
            }
        }

        if ((utf8_strlen($this->request->post['custom_field']['account'][1]) < 1) || (utf8_strlen($this->request->post['custom_field']['account'][1]) > 300)) {
            $json['error']['firma'] = 'Nazwa firmy';
        }
        if ((utf8_strlen($this->request->post['custom_field']['account'][3]) < 1) || (utf8_strlen($this->request->post['custom_field']['account'][3]) > 10)) {
            $json['error']['nip'] = '123456789';
        }
        if ((utf8_strlen($this->request->post['custom_field']['account'][4]) < 1) || (utf8_strlen($this->request->post['custom_field']['account'][4]) > 300)) {
            $json['error']['adres'] = 'Pełny adres';
        }
        if ((utf8_strlen($this->request->post['custom_field']['account'][6]) < 1) || (utf8_strlen($this->request->post['custom_field']['account'][6]) > 50)) {
            $json['error']['misto'] = 'Miejscowość';
        }
        if ((utf8_strlen($this->request->post['custom_field']['account'][7]) < 1) || (utf8_strlen($this->request->post['custom_field']['account'][7]) > 6)) {
            $json['error']['kod'] = '12345 lub 123-45';
        }
        
        if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
            $json['error']['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
            $json['error']['lastname'] = $this->language->get('error_lastname');
        }
        if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
            $json['error']['telephone'] = $this->language->get('error_telephone');
        }

        if (!filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
            $json['error']['email'] = $this->language->get('error_email');
        }

        $this->load->model('account/customer');
        if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
            $json['error']['warning'] = $this->language->get('error_exists');
        }

        if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 40)) {
            $json['error']['password'] = $this->language->get('error_password');
        }

        if (!$json) {
            $customer_id = $this->model_account_customer->addCustomer($this->request->post);

            // Send mail about account awaiting admin approval
            $this->load->language('mail/register');

            $data = [];
            $data['text_welcome'] = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
            $data['text_login'] = $this->language->get('text_login');
            $data['text_approval'] = $this->language->get('text_approval');
            $data['text_service'] = $this->language->get('text_service');
            $data['text_thanks'] = $this->language->get('text_thanks');

            // Always require admin approval for new accounts
            $data['approval'] = true;
            $this->load->model('account/customer_group');
            if (isset($this->request->post['customer_group_id'])) {
                $customer_group_id = (int)$this->request->post['customer_group_id'];
            } else {
                $customer_group_id = $this->config->get('config_customer_group_id');
            }

            $customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

            if ($customer_group_info) {
                $data['approval'] = $customer_group_info['approval'];
            } else {
                $data['approval'] = '';
            }

            $data['login'] = $this->url->link('account/login', '', true);
            $data['store'] = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

            $mail = new Mail($this->config->get('config_mail_engine'));
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->request->post['email']);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')));
            $mail->setText($this->load->view('mail/register', $data));
            $mail->send();

            $this->customer->login($this->request->post['email'], $this->request->post['password']);
            $this->session->data['customer_id'] = $customer_id;
            $json['redirect'] = $this->url->link('account/edit');
        }

        $this->response->addHeader('Content-Type: application/json');
        // $this->response->redirect($this->url->link('account/success'));
		$this->response->setOutput(json_encode($json));
    }

}
