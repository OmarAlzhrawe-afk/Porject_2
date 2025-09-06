<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class LeaveOrderNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $title;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message
        ];
    }

    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'title' => 'Leave Demand',
    //         'message' => $this->message->name . " requested a leave on " . $this->leave->leave_date,
    //     ]);
    // }

    // public function broadcastOn()
    // {
    //     return ['school-channel'];
    // }

    // public function broadcastAs()
    // {
    //     return 'leave-demand';
    // }
}
