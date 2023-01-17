<?php

class Model_Task extends Model {
    public function add() {
        $user = $this->getAuthUser();

        if (!$user) {
            return false;
        }

        if ($_POST['taskDescription'] == "")
            return false;

        return $GLOBALS['db']->addTask($user['id'], $_POST['taskDescription']);
    }

    public function changeStatus($taskId) {
        $user = $this->getAuthUser();

        if (!$user) {
            return false;
        }

        return $GLOBALS['db']->changeTaskStatus($user['id'], $taskId);
    }

    public function remove($taskId) {
        $user = $this->getAuthUser();

        if (!$user) {
            return false;
        }

        return $GLOBALS['db']->removeTask($user['id'], $taskId);
    }

    public function readyAll() {
        $user = $this->getAuthUser();

        if (!$user) {
            return false;
        }

        return $GLOBALS['db']->readyAllTasks($user['id']);
    }

    public function removeAll() {
        $user = $this->getAuthUser();

        if (!$user) {
            return false;
        }

        return $GLOBALS['db']->removeAllTasks($user['id']);
    }

    private function getAuthUser() {
        session_start();

        if (!isset($_SESSION['login'])) {
            return false;
        }

        $users = $GLOBALS['db']->getUserByLogin($_SESSION['login']);

        if (count($users) == 0) {
            return false;
        }

        return $users[0];
    }
}