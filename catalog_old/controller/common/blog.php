<?php
class ControllerCommonBlog extends Controller {
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
                'text' => 'Blog', // Польский для текущей страницы
                'href' => $this->url->link('common/blog')
            ]
        ];

		$this->response->setOutput($this->load->view('common/blog', $data));
	}
}
