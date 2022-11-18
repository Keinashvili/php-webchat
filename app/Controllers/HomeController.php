<?php

namespace app\Controllers;

use models\User;

class HomeController
{
    public function users()
    {
        if (isset($_SESSION['unique_id'])) {
            $users = User::all();
            return view('users.php', compact('users'));
        }
        return view('users.php');
    }

    public function chat($id)
    {
        if (isset($_SESSION['unique_id'])) {
            $_SESSION['id'] = $id;
            $user = User::where('unique_id', $_SESSION['id']);
            return view('chat.php', compact('user'));
        }
        return view('chat.php');
    }
}