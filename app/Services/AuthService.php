<?php

namespace app\Services;

use app\core\Router;
use models\User;
use requests\AuthRequest;

class AuthService
{
    public function __construct()
    {
        Router::get('/register', function (){
            $this->create();
        });
    }

    private function index()
    {
        return view('login.php');
    }

    private function create()
    {
        return view('register.php');
    }

    private function store(AuthRequest $request)
    {
        $request->validateData();
        User::create([

        ]);
    }
}