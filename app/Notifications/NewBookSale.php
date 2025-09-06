<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewBookSale extends Notification
{
    use Queueable;
    protected $title;
    protected $message;
    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }
    public function via()
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
        ];
    }
}
