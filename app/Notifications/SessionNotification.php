<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionNotification extends Notification
{
    use Queueable;

    protected $session_data;
    public function __construct($session)
    {
        $this->session_data = $session;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Session Notification',
            'data' => $this->session_data
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Session Notification',
            'data' => $this->session_data
        ];
    }
}
