<?php

class MainModel extends Model {

    public function getUser($login) {
        return $GLOBALS['db']->query("SELECT * FROM `users` WHERE `users`.`login` = ?", array($login));
    }

    public function getTasks($login) {
        return $GLOBALS['db']->query("SELECT `tasks`.`id`, `tasks`.`description`, `tasks`.`status` FROM `tasks` WHERE `tasks`.`users_id` = (SELECT `users`.`id` FROM `users` WHERE `users`.`login` = ?)", array($login));
    }
}