<?php

namespace app\Services\auth;

use app\core\Request;
use models\User;
use requests\AuthRequest;
use traits\auth\Login;

class AuthService
{
    private string $email;
    private string $password;
    private $id;

    use Login;

    public function auth(): void
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

    public function logout($id): void
    {
        User::update('id', $id, [
            'status' => 'Offline now'
        ]);
        session_unset();
        session_destroy();
        header("location: /login");
    }

    public function login(Request $request): void
    {
        if (!empty($request->email) && !empty($request->password)) {
            if ($this->email == $request->email && $this->password == password_verify($request->password, $this->password)) {
                $_SESSION['loggedInUser'] = $this->id;
                User::update('id', $this->id, [
                    'status' => "Active now"
                ]);
            }
        }
        $this->users($request);
        $this->validate($request);
        header("Location: /");

    }

    public function create(): void
    {
        $this->auth();
        view('register.php');
    }

    public function store(AuthRequest $request): void
    {
        $request->validateData();
        if ($request->password != $request->password_again) {
            $_SESSION['password_again'] = "Passwords dont match!";
            header("Location: /register");
        } else {
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
        }
    }
}