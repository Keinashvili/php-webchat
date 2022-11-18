<?php

namespace app\Controllers;

use models\Message;
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
            $messages= Message::orderBY('ASC', 'msg_id');
            return view('chat.php', compact('messages'));
        }
        return view('chat.php');
    }
}