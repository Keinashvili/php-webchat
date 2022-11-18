<?php

namespace app\Services;

use models\Message;
use models\User;

class MessageService
{
    public string $newMessage;
    public $newIncoming;
    public $newOutgoing;
    private array $messages;

    public function __construct($img = null)
    {
        $this->messages = Message::orderBY('DESC', 'msg_id', 1);
        foreach ($this->messages as $message) {
            $this->newOutgoing = $message->outgoing_msg_id;
            $this->newIncoming = $message->incoming_msg_id;
            if ($message->msg != '') {
                if ($message->incoming_msg_id == $_SESSION['unique_id']) {
                    $this->newMessage = $message->msg;
                } elseif ($message->outgoing_msg_id == $_SESSION['unique_id']) {
                    $this->newMessage = "You: $message->msg";
                } else {
                    $this->newMessage = "No message available";
                }
            }
        }
    }

    public function getChat(): void
    {
        $user = User::where('unique_id', $_SESSION['id']);
        $img = $user['img'];

        $outgoing_id = $_SESSION['unique_id'];
        $output = "";
        $sql = "SELECT * FROM messages";
        $query = Message::query($sql);
        foreach ($query as $item) {
            $message = $item['msg'];
            $out = $item['outgoing_msg_id'];
            $in = $item['incoming_msg_id'];
            if ($out == $outgoing_id) {
                $output = '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $message . '</p>
                                </div>
                           </div>';
            }
            if ($in == $outgoing_id) {
                $output = '<div class="chat incoming">
                                <img src="' . BASE_URI . '/avatars/' . $img . '" alt="">
                                <div class="details">
                                    <p>' . $message . '</p>
                                </div>
                           </div>';
            }
            echo $output;
        }
    }
}