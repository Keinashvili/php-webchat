<?php

namespace app\Controllers;

use models\Message;
use models\User;

class HomeController
{
    private function auth(): void
    {
        if (!isset($_SESSION['unique_id'])) {
            header("location: /login");
        }
    }

    public function users()
    {
        $this->auth();
        $users = User::all();
        return view('users.php', compact('users'));
    }

    public function chat($id)
    {
        $this->auth();
        $_SESSION['id'] = (int)$id;
        $user = User::where('unique_id', $_SESSION['id']);
        return view('chat.php', compact('user'));
    }

    public function sendMessage()
    {
        Message::create([
            'incoming_msg_id' => $_SESSION['id'],
            'outgoing_msg_id' => $_SESSION['unique_id'],
            'msg' => $_POST['message'],
        ]);
    }
}