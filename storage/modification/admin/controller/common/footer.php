<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		if ($this->user->isLogged() && isset($this->request->get['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
			$data['text_version'] = sprintf($this->language->get('text_version'), VERSION);
		} else {
			$data['text_version'] = '';
		}


			$data['me_fb_events_status'] = $this->config->get('module_me_fb_events_status');
		$data['me_fb_events_pixel_id'] = $this->config->get('module_me_fb_events_pixel_id');
		$data['me_fb_events_track_search'] = $this->config->get('module_me_fb_events_track_search');
		if($this->customer->isLogged()){
			$data['customer_id'] = $this->customer->getId();
		}else{
			$data['customer_id'] = 0;
		}
			if($this->config->get('module_me_fb_events_status')){
					$this->document->addScript('catalog/view/javascript/me_fb_events/common.js');
				}
			
		return $this->load->view('common/footer', $data);
	}
}
