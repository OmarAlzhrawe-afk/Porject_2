<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupervisorNotification extends Notification
{
    use Queueable;
    protected $message;
    protected $SenderName;
    public function __construct($message, $SenderName)
    {
        $this->message = $message;
        $this->SenderName = $SenderName;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Specefic Notification',
            'message' => $this->message,
            'SenderName' => $this->SenderName
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Specefic Notification',
            'message' => $this->message,
            'SenderName' => $this->SenderName
        ];
    }
}
