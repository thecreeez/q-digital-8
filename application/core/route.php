<?php

spl_autoload_register(function ($class) {
    if (stripos($class, 'Controller')) {
        require_once 'application/controllers/' . $class . '.php';
    } else if (stripos($class, 'Model')) {
        require_once 'application/models/' . $class . '.php';
    }
});

class Route {
    static function start() {
        $controllerName = 'MainController';
        $actionName = 'index';
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if (!empty($routes[1])) {    
            $controllerName = ucfirst(strtolower($routes[1])).'Controller';
        }
        
        // получаем имя метода
        if (!empty($routes[2])) {
            $actionName = strtolower($routes[2]);
        }

        // добавляем префиксы
        $actionName = 'action_'.$actionName;
        
        $controller = new $controllerName;
        $action = $actionName;
        
        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    
    }
    
    static function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        exit();
    }
}