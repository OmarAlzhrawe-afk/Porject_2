<?php

namespace App\Events\NotificationsEvent;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HomeworkAddedNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $message;

    public function __construct($title, $message)
    {
        $this->message = $message;
        $this->title = $title;
    }
    public function broadcastOn()
    {
        return new Channel('school-channel');
    }

    public function broadcastAs()
    {
        return 'Adding-homework';
    }
}
