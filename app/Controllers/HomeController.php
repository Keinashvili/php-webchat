<?php

namespace app\Controllers;

use models\Message;
use models\User;

class HomeController
{
    private function auth(): void
    {
        if (!isset($_SESSION['loggedInUser'])) {
            header("location: /login");
        }
    }

    public function users(): bool
    {
        $this->auth();
        $users = User::all();
        return view('users.php', compact('users'));
    }

    public function chat($id): bool
    {
        $this->auth();
        $_SESSION['otherUser'] = (int)$id;
        $user = User::where('id', $_SESSION['otherUser']);
        return view('chat.php', compact('user'));
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