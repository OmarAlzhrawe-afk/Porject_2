<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

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
    public function toDatabase()
    {
        return [
            'title' => 'Leave Order Notification',
            'leave' =>  $this->leave,
            'user' =>  $this->user
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Leave Order Notification',
            'leave' =>  $this->leave,
            'user' =>  $this->user
        ]);
    }
}
