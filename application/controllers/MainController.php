<?php

class MainController extends Controller {
	function __construct() {
		$this->model = new MainModel();
		$this->view = new View();
	}

	function action_index() {	
		$user = $this->model->getUser($_SESSION['login']);
		$data = array(
			'isAuth' => false
		);

		if (count($user) != 0) {
			$data['login'] = $user[0]['login'];
			$data['tasks'] = $this->model->getTasks($user[0]['login']);
			$data['isAuth'] = true;
		}

		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
}