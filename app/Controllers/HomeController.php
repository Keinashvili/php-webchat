<?php

namespace app\Controllers;

use models\Message;
use models\User;

class HomeController
{
    public function users()
    {
        if (isset($_SESSION['loggedInUser'])) {
            $users = User::all();
            return view('users.php', compact('users'));
        } else {
            redirect('login');
        }
    }

    public function chat($id)
    {
        if (isset($_SESSION['loggedInUser'])) {
            $_SESSION['otherUser'] = (int)$id;
            $user = User::where('id', $_SESSION['otherUser']);
            return view('chat.php', compact('user'));
        } else {
            redirect('/login');
        }
    }

    public function sendMessage(): void
    {
        Message::create([
            'incoming' => $_SESSION['otherUser'],
            'outgoing' => $_SESSION['loggedInUser'],
            'message' => $_POST['message'],
        ]);
    }
}