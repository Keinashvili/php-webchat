<?php

namespace app\Controllers;

use models\User;

class HomeController
{
    public function index()
    {
        if (isset($_SESSION['unique_id'])) {
            $users = User::where('unique_id', $_SESSION['unique_id']);
            return view('users.php', compact('users'));
        }
        return view('users.php');
    }
}