<?php
class ControllerCommonFooter extends Controller {
    public function index() {
        $this->load->language('common/footer');
        $this->load->model('catalog/information');

        $data['informations'] = array();

        foreach ($this->model_catalog_information->getInformations() as $result) {
            if ($result['bottom']) {
                $data['informations'][] = array(
                    'title' => $result['title'],
                    'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
                );
            }
        }

        $data['sitemap']     = $this->url->link('information/sitemap');
        $data['tracking']    = $this->url->link('information/tracking');
        $data['manufacturer'] = $this->url->link('product/manufacturer');
        $data['voucher']     = $this->url->link('account/voucher', '', true);
        $data['affiliate']   = $this->url->link('affiliate/login', '', true);
        $data['special']     = $this->url->link('product/special');
        $data['account']     = $this->url->link('account/account', '', true);
        $data['order']       = $this->url->link('account/order', '', true);
        $data['wishlist']    = $this->url->link('account/wishlist', '', true);
        $data['newsletter']  = $this->url->link('account/newsletter', '', true);

        $data['powered'] = sprintf(
            $this->language->get('text_powered'),
            $this->config->get('config_name'),
            date('Y', time())
        );

        // Whos Online
        if ($this->config->get('config_customer_online')) {
            $this->load->model('tool/online');

            $ip = $this->request->server['REMOTE_ADDR'] ?? '';
            $url = (isset($this->request->server['HTTP_HOST'], $this->request->server['REQUEST_URI']))
                ? (($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'])
                : '';
            $referer = $this->request->server['HTTP_REFERER'] ?? '';

            $this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
        }

        $data['scripts']     = $this->document->getScripts('footer');
        $data['styles']      = $this->document->getStyles('footer');
        $data['schemas_org'] = $this->document->getSchema();
        $data['cookie']      = $this->load->controller('common/cookie');

        return $this->load->view('common/footer', $data);
    }
}