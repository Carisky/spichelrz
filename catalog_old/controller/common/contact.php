<?php

class ControllerCommonContact extends Controller {
	/**
	 * @return void
	 */
	public function index(): void {

        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
	

        $data['breadcrumbs'] = [
            [
                'text' => 'Główna', // Польский для "Главная"
                'href' => $this->url->link('common/home')
            ],
            [
                'text' => 'Kontakt', // Польский для текущей страницы
                'href' => $this->url->link('common/contact')
            ]
        ];


		$this->response->setOutput($this->load->view('common/contact_us', $data));

    }
}