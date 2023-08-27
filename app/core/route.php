<?php

class Route
{
    public static function init()
    {
        $controllerName = 'App';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controllerName = ucfirst($routes[1]);
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
            $strPos = strpos($routes[2], "?");
            if (strpos($routes[2], "?")) {
                $actionName = substr($routes[2], 0, $strPos);
            }
        }

        $modelName = $controllerName;
        $controllerName = $controllerName . 'Controller';

        $modelFile = $modelName . '.php';
        $modelPath = '../app/models/' . $modelFile;
        if (file_exists($modelPath)) {
            require $modelPath;
        }

        $controllerFile = $controllerName . '.php';
        $controllerPath = '../app/controllers/' . $controllerFile;

        if (file_exists($controllerPath)) {
            require $controllerPath;
            $controller = new $controllerName;
            $action = $actionName;

            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                Route::error404();
            }
        } else {
            Route::error404();
        }
    }

    static function error404()
    {
        redirect('app/error404');
    }
}