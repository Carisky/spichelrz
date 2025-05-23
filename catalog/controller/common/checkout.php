<?php
class ControllerCommonCheckout extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        $this->load->language('checkout/checkout');

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->load->model('setting/extension');
        $this->load->model('account/address');

        // Получаем адрес пользователя (если он авторизован)
        if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
            $address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
        } else {
            $address = [
                'country_id' => $this->config->get('config_country_id'),
                'zone_id' =>  $this->config->get('config_zone_id')
            ];
        }

        $payment_methods = [];
        $extensions = $this->model_setting_extension->getExtensions('payment');

        foreach ($extensions as $extension) {
            if ($this->config->get('payment_' . $extension['code'] . '_status')) {
                $this->load->model('extension/payment/' . $extension['code']);
                $method = $this->{'model_extension_payment_' . $extension['code']}->getMethod($address, 0);

                if ($method) {
                    $payment_methods[] = $method;
                }
            }
        }

        $data['payment_methods'] = $payment_methods;

        $data['breadcrumbs'] = [
            [
                'text' => 'Główna',
                'href' => $this->url->link('common/home')
            ],
            [
                'text' => 'Kasa',
                'href' => $this->url->link('common/checkout')
            ]
        ];

        $this->response->setOutput($this->load->view('common/checkout', $data));
    }
}
