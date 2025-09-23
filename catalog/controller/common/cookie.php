<?php
class ControllerCommonCookie extends Controller
{
    public function index()
    {
        // скрываем ТОЛЬКО если уже согласились
        if (!empty($_COOKIE['cookie_consent']) && $_COOKIE['cookie_consent'] === '1') {
            return '';
        }

        $this->load->language('common/cookie');
        $data['text_cookie']     = $this->language->get('text_cookie');
        $data['button_agree']    = $this->language->get('button_agree');
        $data['button_disagree'] = $this->language->get('button_disagree');
        $data['agree']    = $this->url->link('common/cookie/agree');
        $data['disagree'] = $this->url->link('common/cookie/disagree');
        return $this->load->view('common/cookie', $data);
    }

    public function agree()
    {
        setcookie('cookie_consent', '1', [
            'expires'  => time() + 31536000,
            'path'     => '/',
            'secure'   => !empty($_SERVER['HTTPS']),
            'httponly' => false,
            'samesite' => 'Lax',
        ]);
        $this->session->data['cookie_consent'] = true; // можно оставить дублирование
        $this->response->setOutput('1');
    }

    public function disagree()
    {
        setcookie('cookie_consent', '', [
            'expires'  => time() - 3600,
            'path'     => '/',
            'secure'   => !empty($_SERVER['HTTPS']),
            'httponly' => false,
            'samesite' => 'Lax',
        ]);
        unset($this->session->data['cookie_consent']);
        $this->response->setOutput('1');
    }
}
