<?php

use app\core\Router;
use app\Controllers\HomeController;

//Router::get('/', function () {
//    (new HomeController())->index();
//});
//
//Router::get('/test', function () {
//    echo "signed IN";
//});

Router::get('/users', function (){
    (new HomeController())->index();
});