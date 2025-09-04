<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewActivity extends Notification
{
    use Queueable;
    protected $activity;
    public function __construct($activity)
    {
        $this->activity = $activity;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'Title' => 'New activity Added',
            'Message' => 'Adding New  Activity  For' . $this->activity->activity_type . 'If You Want to join to it ',
            // 'activity' =>  $this->activity
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'Title' => 'New activity Added',
            'Message' => 'Adding New  Activity  For' . $this->activity->activity_type . 'If You Want to join to it ',
            // 'activity' =>  $this->activity
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
