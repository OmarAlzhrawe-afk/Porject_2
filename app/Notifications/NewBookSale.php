<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
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
            'title' => 'Book Sale',
            'message' =>  $this->message
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Book Sale',
            'message' =>  $this->message

        ]);
    }
    public function broadcastOn()
    {
        return new Channel('school-channel');
    }
    public function broadcastAs()
    {
        return 'new-notification';
    }
}
