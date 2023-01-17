<?php

class Model_Auth extends Model {
	public function getData()
	{	
        session_start();

        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }
        
        return true;
	}

    public function auth() {
        session_start();

        $users = $GLOBALS['db']->getUserByLogin($_POST['login']);

        if (count($users) == 0) {
            $GLOBALS['db']->insertUser($_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT));
            $_SESSION['login'] = $_POST['login'];
            return true;
        }

        if (!password_verify($_POST['password'], $users[0]['password'])) {
            return false;
        }

        $_SESSION['login'] = $users[0]['login'];
        return true;
    }
}