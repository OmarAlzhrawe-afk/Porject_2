<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveOrderNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $leave;
    public function __construct($user, $leave)
    {
        $this->leave = $leave;
        $this->user = $user;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }
    public function todatabase()
    {
        return [
            'type' => 'Leave Order Notification',
            'leave' =>  $this->leave,
            'user' =>  $this->user
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Leave Order Notification',
            'leave' =>  $this->leave,
            'user' =>  $this->user
        ];
    }
}
