<?php

class AuthController extends Controller {
    function __construct() {
        $this->model = new AuthModel();
        $this->view = new View();
    }

    function action_index() {    
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }

        $this->view->generate('auth_view.php', 'template_view.php');
    }

    function action_post() {
        $users = $this->model->getUser($_POST['login']);

        if (count($users) == 0) {
            $this->model->registerUser($_POST['login'], password_hash($_POST['password'], PASSWORD_BCRYPT));
            $_SESSION['login'] = $_POST['login'];
            echo "registering...";
            return;
        }

        if (!password_verify($_POST['password'], $users[0]['password'])) {
            echo "password not right...";
            return;
        }

        $_SESSION['login'] = $users[0]['login'];
        header("Location: /");
    }
}