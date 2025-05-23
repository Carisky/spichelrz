<?php
class ControllerCommonWorkwithus extends Controller {
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
                'text' => 'Współpraca', // Польский для текущей страницы
                'href' => $this->url->link('common/workwithus')
            ]
        ];


		$this->response->setOutput($this->load->view('common/work_with_us', $data));

    }
}