<?php

namespace app\Services;

use app\core\Request;
use models\User;
use requests\AuthRequest;

class AuthService
{
    private string $email;
    private string $password;
    private $id;

    public function auth()
    {
        if (isset($_SESSION['loggedInUser'])) {
            header("location: /");
        }
    }

    public function index(): void
    {
        $this->auth();
        view('login.php');
    }

    public function logout($id)
    {
        User::update('id', $id, [
            'status' => 'Offline now'
        ]);
        session_unset();
        session_destroy();
        header("location: /login");
    }

    public function login(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($request->email == $user->email) {
                $this->email = $user->email;
                $this->password = $user->password;
            }
        }

        if (!empty($request->email) && !empty($request->password)) {
            if ($this->email == $request->email && $this->password == password_verify($request->password, $this->password)) {
                $id = User::whereByColumn('id', 'users', 'email', "$request->email");
                foreach ($id as $values) {
                    foreach ($values as $value) {
                        $this->id = $value;
                    }
                }
                $_SESSION['loggedInUser'] = $this->id;
                User::update('id', $this->id, [
                    'status' => "Active now"
                ]);
            }
        }
        if (empty($request->email)) {
            $_SESSION['email'] = 'Email is required!';
        }
        if (empty($request->password)) {
            $_SESSION['password'] = 'Password is required!';
        }
        header("Location: /");

    }

    public function create(): void
    {
        $this->auth();
        view('register.php');
    }

    public function store(AuthRequest $request)
    {
        $request->validateData();
        if ($request->password == $request->password_again && $request->password != '' && $request->password_again != '') {
            $encPass = password_hash($request->password, PASSWORD_DEFAULT);
            $id = rand(1, 10000);
            User::create([
                'id' => $id,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'password' => $encPass,
                'img' => image('image', 'avatars'),
                'status' => "Active now",
            ]);
            $_SESSION['loggedInUser'] = $id;
            header("Location: /");
        } else {
            $_SESSION['password_again'] = "Passwords dont match!";
            header("Location: /register");
        }
    }
}