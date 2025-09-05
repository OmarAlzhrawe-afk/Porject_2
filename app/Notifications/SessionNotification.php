<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SessionNotification extends Notification
{
    use Queueable;

    protected $session_data;
    public function __construct($session_data)
    {
        $this->session_data = $session_data;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase()
    {
        return [
            'title' => 'New Session For You',
            'message' => "Admin Add New Session For You At \n  day:  "  . $this->session_data['session_day']
                . "\n start_time:" . $this->session_data['start_time']
                . "\n teacher_name:" . $this->session_data['teacher_name']
                . "\n subject_name:" . $this->session_data['subject_name']
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'New Session For You',
            'message' => "Admin Add New Session For You At \n  day:  "  . $this->session_data['session_day']
                . "\n start_time:" . $this->session_data['start_time']
                . "\n teacher_name:" . $this->session_data['teacher_name']
                . "\n subject_name:" . $this->session_data['subject_name']
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
