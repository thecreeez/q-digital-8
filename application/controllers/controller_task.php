<?php

class Controller_Task extends Controller {
	function __construct()
	{
		$this->model = new Model_Task();
		$this->view = new View();
	}

	function action_post()
	{
        $args = explode(":", $_POST['requestType']);
        $type = $args[0];

        switch ($type) {
            case "ADD_TASK": $this->model->add(); break;

            case "CHANGE_STATUS_ONE": $this->model->changeStatus($args[1]); break;
            case "REMOVE_ONE": $this->model->remove($args[1]); break;

            case "REMOVE_ALL": $this->model->removeAll(); break;
            case "READY_ALL": $this->model->readyAll(); break;
        }

        header("Location: /");
	}
}