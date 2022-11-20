<?php

use app\core\Router;
use app\Controllers\HomeController;
use app\Services\MessageService;
use app\Services\SearchService;

Router::get('/', function () {
    (new HomeController())->users();
});

Router::get('/chat/{id}', function ($id) {
    (new HomeController())->chat($id);
});

Router::post('/getChat', function (){
    (new MessageService())->getChat();
});

Router::post('/sendMessage', function (){
    (new HomeController())->sendMessage();
});

Router::post('/search', function (){
    (new SearchService())->search();
});