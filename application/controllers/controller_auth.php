<?php

class Controller_Auth extends Controller {
	function __construct() {
		$this->model = new Model_Auth();
		$this->view = new View();
	}

	function action_index() {	
		$data = $this->model->getData();

		$this->view->generate('auth_view.php', 'template_view.php', $data);
	}

    function action_post() {
        $data = $this->model->auth();
        
        header("Location: /");
    }
}