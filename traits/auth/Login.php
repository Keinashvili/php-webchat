<?php

namespace traits\auth;

use app\core\Request;
use models\User;

trait Login
{
    private function users(Request $request): void
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($request->email == $user->email) {
                $this->email = $user->email;
                $this->password = $user->password;
            }
        }
        $id = User::whereByColumn('id', 'users', 'email', "$request->email");
        foreach ($id as $values) {
            foreach ($values as $value) {
                $this->id = $value;
            }
        }
    }

    private function validate(Request $request): void
    {
        if (empty($request->email)) {
            $_SESSION['email'] = 'Email is required!';
        }
        if (empty($request->password)) {
            $_SESSION['password'] = 'Password is required!';
        }
    }

}