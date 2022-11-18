<?php

namespace app\Services;

use app\core\Router;
use models\User;
use requests\AuthRequest;

class AuthService
{
    private string $email;
    private string $password;
    private $id;

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
        $users = User::all();

        foreach ($users as $user) {
            if ($request->email == $user->email) {
                $this->email = $user->email;
                $this->password = $user->password;
            }
        }

        if ($this->email == $request->email && $this->password == password_verify($request->password, $this->password)) {
            $uniqueID = User::whereByColumn('unique_id', 'users', 'email', "$request->email");
            foreach ($uniqueID as $values) {
                foreach ($values as $value) {
                    $this->id = $value;
                }
            }
            $_SESSION['unique_id'] = $this->id;
            User::update('unique_id', $this->id, [
                'status' => "Active now"
            ]);
            echo "success";
        } elseif ($this->email != $request->email) {
            echo 'email error';
        } elseif (!password_verify($request->password, $this->password)) {
            echo 'pass error';
        }

    }

    private function create(): void
    {
        view('register.php');
    }

    private function store(AuthRequest $request)
    {
        $request->validateData();
        $encPass = password_hash($request->password, PASSWORD_DEFAULT);
        $unique_id = rand(time(), 100000000);
        User::create([
            'unique_id' => $unique_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => $encPass,
            'img' => image('image', 'avatars'),
            'status' => "Active now",
        ]);

        $_SESSION['unique_id'] = $unique_id;
        echo "success";
    }
}