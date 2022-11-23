<?php

namespace traits\auth;

use requests\AuthRequest;

trait Register
{
    private function registerValidate(AuthRequest $request): void
    {
        if ($request->password != $request->password_again) {
            $_SESSION['password_again'] = "Passwords dont match!";
            header("Location: /register");
        }
    }

    private function hashPassword(AuthRequest $request)
    {
        if ($request->password == $request->password_again) {
            return password_hash($request->password, PASSWORD_DEFAULT);
        }
    }
}