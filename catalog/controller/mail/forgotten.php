<?php
class ControllerMailForgotten extends Controller {
	public function index(&$route, &$args, &$output) {			            
        $this->load->language('mail/forgotten');

        $store_name = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
        $data['text_greeting'] = sprintf($this->language->get('text_greeting'), $store_name);
        $data['text_change'] = $this->language->get('text_change');
        $data['text_ip'] = $this->language->get('text_ip');
        $data['text_thanks'] = $this->language->get('text_thanks');
        $data['text_team'] = sprintf($this->language->get('text_team'), $store_name);
        
        $data['reset'] = str_replace('&amp;', '&', $this->url->link('account/reset', 'code=' . $args[1], true));
        $data['ip'] = $this->request->server['REMOTE_ADDR'];
		
		$mail = new Mail($this->config->get('config_mail_engine'));
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($args[0]);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode(sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8'));
		$mail->setText($this->load->view('mail/forgotten', $data));
		$mail->send();
	}
}
