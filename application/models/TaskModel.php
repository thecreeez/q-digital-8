<?php

class TaskModel extends Model {
    public function add($usersId, $description) {
        return $GLOBALS['db']->query("INSERT INTO `tasks` (`users_id`, `description`) VALUES (?, ?)", array($usersId, $description));
    }

    public function changeStatus($usersId, $tasksId) {
        return $GLOBALS['db']->query("UPDATE `tasks` SET `tasks`.`status` = `tasks`.`status` ^ 1 WHERE `tasks`.`users_id` = ? AND `tasks`.`id` = ?", array($usersId, $tasksId));
    }

    public function remove($usersId, $tasksId) {
        return $GLOBALS['db']->query("DELETE FROM `tasks` WHERE `tasks`.`users_id` = ? AND `tasks`.`id` = ?", array($usersId, $tasksId));
    }

    public function removeAll($usersId) {
        return $GLOBALS['db']->query("DELETE FROM `tasks` WHERE `tasks`.`users_id` = ?", array($usersId));
    }

    public function readyAll($usersId) {
        return $GLOBALS['db']->query("UPDATE `tasks` SET `tasks`.`status` = 1 WHERE `tasks`.`users_id` = ? AND `tasks`.`status` = 0", array($usersId));
    }

    public function getUser($login) {
        return $GLOBALS['db']->query("SELECT * FROM `users` WHERE `users`.`login` = ?", array($login));
    }
}