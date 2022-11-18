<?php

namespace app\Services;

use models\Message;

class MessageService
{
    public string $newMessage;
    public $newIncoming;
    public $newOutgoing;
    private array $messages;

    public function __construct()
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

    public function outGoing($uniqueID): void
    {
        $messages = Message::whereByColumn('msg', 'messages', 'outgoing_msg_id', $uniqueID);
        foreach ($messages as $message) {
            foreach ($message as $item) {
                echo "<div class='chat outgoing'>
                        <div class='details'>
                        <p>$item</p>
                        </div>
                        </div>";
            }
        }
    }

    public function inComing($id, $img): void
    {
        $messages = Message::whereByColumn('msg', 'messages', 'outgoing_msg_id', $id);
        foreach ($messages as $message) {
            foreach ($message as $item) {
                echo "<div class='chat incoming'>
                        <img src=" . BASE_URI . '/avatars/' . $img . " alt=''>
                        <div class='details'>
                        <p>$item</p>
                        </div>
                        </div>";
            }
        }
    }
}