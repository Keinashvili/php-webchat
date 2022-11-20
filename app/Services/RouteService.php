<?php

namespace app\Services;

use app\core\Router;

class RouteService
{

    public static function run()
    {
        routes('web.php');
        routes('auth/auth.php');
    }

    public static function boot()
    {
       $action = $_SERVER['REQUEST_URI'];
       Router::run($action);
    }
}