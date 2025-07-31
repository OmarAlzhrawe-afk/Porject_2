<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class New_Pre_Regesteration extends Notification
{
    use Queueable;
    protected $pre;
    public function __construct($pre)
    {
        $this->pre = $pre;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }
    public function todatabase()
    {
        return [
            'type' => 'Leave Accepted Notification',
            'data' =>  $this->pre
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Session Notification',
            'leave' => $this->pre
        ];
    }
}
