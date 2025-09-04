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

    public function toDatabase()
    {
        return [
            'title' => 'Leave Accepted Notification',
            'leave' => $this->leave,
            'deducation' => $this->deducation
        ];
    }
    public function toBroadcast()
    {
        return [
            'title' => 'Leave Accepted Notification',
            'leave' => $this->leave,
            'deducation' => $this->deducation
        ];
    }
}
