<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MarkNotification extends Notification
{
    use Queueable;
    protected $mark;
    public function __construct($mark)
    {
        $this->mark = $mark;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Enrolling mark Notification',
            'mark' => $this->mark,
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Enrolling mark Notification',
            'mark' => $this->mark,
        ];
    }
}
