<?php
class Route
{
    static $routes;

    static function start()
    {
        $controller_name = 'Auth';
        $action_name = 'index';

        Route::$routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty(Route::$routes[1]) )
        {
            $controller_name = Route::$routes[1];
        }

        if ( !empty(Route::$routes[2]) )
        {
            $action_name = Route::$routes[2];
        }

        $params = array();
        for($i = 3; !empty(Route::$routes[$i]); $i++)
            $params[] = Route::$routes[$i];

        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;


        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            $controller->$action($params);
        }
        else
        {
            Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }


    static function redirect($url)
    {
        if($_SERVER['REQUEST_URI'] != $url)
        {
            header("Location: " . $url);
            exit(0);
        }
    }
}