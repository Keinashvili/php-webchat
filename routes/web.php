<?php

use app\core\Router;
use app\Controllers\HomeController;
use app\Services\MessageService;

Router::get('/', function () {
    (new HomeController())->users();
});

Router::get('/chat/{id}', function ($id) {
    (new HomeController())->chat($id);
});

Router::post('/getChat', function (){
    (new MessageService())->getChat();
});