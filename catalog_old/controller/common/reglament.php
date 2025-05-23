<?php
class ControllerCommonReglament extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
	

        $data['breadcrumbs'] = [
            [
                'text' => 'Główna', // Польский для "Главная"
                'href' => $this->url->link('common/home')
            ],
            [
                'text' => 'Regulamin sklepu', // Польский для текущей страницы
                'href' => $this->url->link('common/faq')
            ]
        ];

		$this->response->setOutput($this->load->view('common/reglament', $data));
	}
}
