<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveNotification extends Notification
{
    use Queueable;
    protected $deducation;
    protected $leave;
    public function __construct($deducation, $leave)
    {
        $this->deducation = $deducation;
        $this->leave = $leave;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Leave Accepted Notification',
            'data' =>  $this->leave
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Session Notification',
            'leave' => $this->leave,
            'deducation' => $this->deducation
        ];
    }
}
