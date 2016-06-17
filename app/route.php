<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 23.05.2016
 * Time: 14:49.
 */

namespace app;

function __autoload($class){

        require __DIR__."/controllers/$class.php";

}


use app\controllers\AdminController;
use app\controllers\SiteController;

class route
{
    public static function start()
    {
        $controller_name = 'Site';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }
        $ind = strtolower($controller_name);
        if ($ind != 'site' && $ind != 'admin') {
            self::ErrorPage404();
        }

        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $model_name = $controller_name;
        $controller_name = $controller_name . 'Controller';
        $action_name = 'action_' . $action_name;

        $model_file = strtolower($model_name) . '.php';

        require 'models/Site.php';
        require 'models/Admin.php';

        $controller_file = strtolower($controller_name) . '.php';

       require 'controllers/'.$controller_file;

        if ($ind == 'site') {
            $controller = new SiteController();
        } elseif ($ind == 'admin') {
            $controller = new AdminController();
        } else {
            self::ErrorPage404();
        }
        $action = $action_name;
        $controller->$action();
    }

    public static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        echo 404;
    }
}
