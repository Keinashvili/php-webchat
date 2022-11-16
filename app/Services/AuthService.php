<?php

namespace app\Services;

use app\core\Router;
use models\User;
use requests\AuthRequest;

class AuthService
{
    public function __construct()
    {
        Router::get('/register', function () {
            $this->create();
        });

        Router::get('/login', function () {
            $this->index();
        });

        Router::post('/login', function () {
            $this->login(new AuthRequest());
        });

        Router::post('/register', function () {
            $this->store(new AuthRequest());
        });

        Router::post('/logout/{id}', function ($id) {
            $this->logout($id);
        });
    }

    private function index(): void
    {
        view('login.php');
    }

    private function logout($id)
    {
        User::update('unique_id', $id, [
            'status' => 'Offline now'
        ]);
        session_unset();
        session_destroy();
        header("location: /login");
    }

    private function login(AuthRequest $request)
    {
        $email = User::oneData('email');
        $password = User::oneData('password');

        $userPassword = md5($request->password);
        if ($email == $request->email && $password == $userPassword) {
            $_SESSION['unique_id'] = User::oneData('unique_id');
            User::update('unique_id', $_SESSION['unique_id'], [
                'status' => "Active now"
            ]);
            echo "success";
        }

    }

    private function create(): void
    {
        view('register.php');
    }

    private function store(AuthRequest $request)
    {
        $request->validateData();
        $encPass = md5($request->password);
        $unique_id = rand(time(), 100000000);
        User::create([
            'unique_id' => $unique_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => $encPass,
            'img' => '$_FILES[]',
            'status' => "Active now",
        ]);
        $_SESSION['unique_id'] = $unique_id;
        echo "success";
    }
}