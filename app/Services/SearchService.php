<?php

namespace app\Services;

use models\Message;
use models\User;
use app\Services\MessageService;

class SearchService
{
    public function search()
    {
        $outgoing_id = $_SESSION['loggedInUser'];
        $searchTerm = $_POST['searchTerm'];
        $sql = "SELECT * FROM users WHERE NOT id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
        $query = Message::query($sql);
        $users = User::all();
        $output = "";
        $message = new MessageService();

        if (!empty($query)) {
            foreach ($users as $user) {
                if ($user->id != $_SESSION['loggedInUser']) {
                    $message->getMessage($user->id);
                    ($user->status == "Offline now") ? $offline = "offline" : $offline = "";
                    $output .= '<a href="/chat/' . $user->id . '"> 
                                <div class="content">
                                   <img src="avatars/' . $user->img . '">
                                   <div class="details">
                                   <span>' . $user->fname . " " . $user->lname . '</span>
                                   <p>' . $message->newMessage . '</p>
                                   </div>
                                </div>
                                <div class="status-dot ' . $offline . '; "><i class="fas fa-circle"></i></div>
                               </a>';
                }
            }
        } else {
            $output .= 'No user found related to your search term';
        }
        echo $output;
    }
}