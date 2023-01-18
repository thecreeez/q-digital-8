<?php

class AuthModel extends Model {

    public function getUser($login) {
        return $GLOBALS['db']->query("SELECT * FROM `users` WHERE `users`.`login` = ?", array($login));
    }

    public function registerUser($login, $password) {
        return $GLOBALS['db']->query("INSERT INTO `users` (`login`, `password`) VALUES (?, ?)", array($login, $password));
    }
}