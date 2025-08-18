<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatedActivityNotification extends Notification
{
    use Queueable;
    protected $message;
    protected $activity;
    public function __construct($activity)
    {
        $this->activity = $activity;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Specefic Notification',
            'message' => "Activity Updated",
            'SenderName' => $this->activity
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Specefic Notification',
            'message' => "Activity Updated",
            'SenderName' => $this->activity
        ];
    }
}
