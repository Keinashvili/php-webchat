<?php

namespace requests;

use app\core\Request;

class AuthRequest extends Request
{
    public function rules()
    {
        return [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ];
    }
}