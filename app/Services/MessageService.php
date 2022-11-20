<?php

namespace app\Services;

use models\Message;
use models\User;

class MessageService
{
    public mixed $newMessage;

    public function __construct()
    {
        $this->newMessage = "No message available";
    }

    public function getMessage($userId): void
    {
        $messages = Message::query("SELECT * FROM messages ORDER BY id ASC");
        foreach ($messages as $message) {
            if ($message['incoming'] == $userId && $message['outgoing'] == $_SESSION['loggedInUser']) {
                $newMessage = $message['message'];
                $this->newMessage = "You: $newMessage";
            }
            if ($message['outgoing'] == $userId && $message['incoming'] == $_SESSION['loggedInUser']) {
                $this->newMessage = $message['message'];
            }
        }
    }

    public function getChat(): void
    {
        $user = User::where('id', $_SESSION['otherUser']);
        $img = $user['img'];

        $outgoingID = $_SESSION['loggedInUser'];
        $incomingID = $_SESSION['otherUser'];
        $output = "";
        $sql = "SELECT * FROM messages";
        $query = Message::query($sql);

        if (empty($query)) {
            echo '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        foreach ($query as $item) {
            $message = $item['message'];
            $out = $item['outgoing'];
            $in = $item['incoming'];
            if ($out == $outgoingID && $incomingID == $in) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $message . '</p>
                                </div>
                           </div>';
            }
            if ($in == $outgoingID && $out == $incomingID) {
                $output .= '<div class="chat incoming">
                                <img src="' . BASE_URI . '/avatars/' . $img . '" alt="">
                                <div class="details">
                                    <p>' . $message . '</p>
                                </div>
                           </div>';
            }
        }
        echo $output;
    }
}
