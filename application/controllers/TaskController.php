<?php

class TaskController extends Controller {
	function __construct() {
		$this->model = new TaskModel();
		$this->view = new View();
	}

	function action_post() {
        if (!isset($_SESSION['login'])) {
            return header("Location: /");
        }

        $users = $this->model->getUser($_SESSION['login']);

        if (count($users) == 0) {
            return header("Location: /");
        }

        $args = explode(":", $_POST['requestType']);
        $type = $args[0];

        switch ($type) {
            case "ADD_TASK": $this->add($users[0]); break;

            case "CHANGE_STATUS_ONE": $this->changeStatus($users[0], $args[1]); break;
            case "REMOVE_ONE": $this->remove($users[0], $args[1]); break;

            case "REMOVE_ALL": $this->removeAll($users[0]); break;
            case "READY_ALL": $this->readyAll($users[0]); break;
        }

        header("Location: /");
	}

    private function add($user) {
        if ($_POST['taskDescription'] == "")
            return false;

        return $this->model->add($user['id'], $_POST['taskDescription']);
    }

    private function changeStatus($user, $taskId) {
        return $this->model->changeStatus($user['id'], $taskId);
    }

    private function remove($user, $taskId) {
        return $this->model->remove($user['id'], $taskId);
    }

    private function removeAll($user) {
        return $this->model->removeAll($user['id'], $taskId);
    }

    private function readyAll($user) {
        return $this->model->readyAll($user['id'], $taskId);
    }
}