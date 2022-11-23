<?php

use app\core\Router;
use app\Services\auth\AuthService;
use requests\AuthRequest;

Router::get('/register', function () {
    (new AuthService)->create();
});

Router::get('/login', function () {
    (new AuthService)->index();
});

Router::post('/login', function () {
    (new AuthService)->login(new AuthRequest());
});

Router::post('/register', function () {
    (new AuthService)->store(new AuthRequest());
});

Router::post('/logout/{id}', function ($id) {
    (new AuthService)->logout($id);
});