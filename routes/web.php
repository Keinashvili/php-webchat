<?php

use app\core\Router;
use app\Controllers\HomeController;

Router::get('/', function () {
    (new HomeController())->users();
});

Router::get('/chat/{id}', function ($id) {
    (new HomeController())->chat($id);
});