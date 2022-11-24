<?php

namespace app\Services\auth;

use app\core\Request;
use models\User;
use requests\AuthRequest;
use traits\auth\Login;
use traits\auth\Register;

class AuthService
{
    private string $email;
    private string $password;
    private $id;

    use Login;
    use Register;

    public function index()
    {
        if (!isset($_SESSION['loggedInUser'])) {
            return view('login.php');
        } else {
            header("location: /");
        }
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
        $this->users(new AuthRequest());
        $this->loginValidate($request);
        if ($this->email == $request->email && $this->password == password_verify($request->password, $this->password)) {
            $_SESSION['loggedInUser'] = $this->id;
            User::update('id', $this->id, [
                'status' => "Active now"
            ]);
        }
        header("Location: /");

    }

    public function create()
    {
        if (!isset($_SESSION['loggedInUser'])) {
            return view('register.php');
        } else {
            header("location: /");
        }
    }

    public function store(AuthRequest $request): void
    {
        $request->validateData();
        $this->registerValidate($request);
        $id = rand(1, 10000);
        User::create([
            'id' => $id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => $this->hashPassword($request),
            'img' => image('image', 'avatars'),
            'status' => "Active now",
        ]);
        $_SESSION['loggedInUser'] = $id;
        header("Location: /");
    }
}