<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAbsencesNotification extends Notification
{
    use Queueable;

    protected $attendance;
    protected $user_name;
    public function __construct($attendance, $user_name)
    {
        $this->attendance = $attendance;
        $this->user_name = $user_name;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }
    public function todatabase()
    {
        return [
            'title' => 'Attendance',
            'message' => 'Your Children :' . $this->user_name . 'Attendance IS : ' . $this->attendance,
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Attendance',
            'message' => 'Your Children :' . $this->user_name . 'Attendance IS : ' . $this->attendance,
        ]);
    }
    public function broadcastOn()
    {
        return new Channel('school-channel');
    }
    public function broadcastAs()
    {
        return 'new-notification';
    }
}
