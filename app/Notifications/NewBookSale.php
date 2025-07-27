<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookSale extends Notification
{
    use Queueable;
    protected $message;
    public function __construct($message)
    {
        $this->$message = $message;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'New Book Sale Notification',
            'message' =>  $this->message
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'New Book Sale Notification',
            'message' =>  $this->message
        ];
    }
}
