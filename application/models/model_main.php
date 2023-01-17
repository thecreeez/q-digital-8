<?php

class Model_Main extends Model {
	public function getData()
	{	
        session_start();

        if (!isset($_SESSION['login'])) {
            return array(
                'isAuth' => false
            );
        }
        
        $users = $GLOBALS['db']->getUserByLogin($_SESSION['login']);

        if (count($users) == 0) {
            return array(
                'isAuth' => false
            );
        }

        $tasks = $GLOBALS['db']->getTasks($_SESSION['login']);

		return array(
			'isAuth' => true,
			'login' => $users[0]['login'],
            'tasks' => $tasks
		);
	}
}