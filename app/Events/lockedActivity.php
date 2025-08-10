<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class lockedActivity implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $activity;
    public function __construct($activity)
    {
        $this->activity = $activity;
    }
    public function broadcastOn()
    {
        return new Channel('activities');
    }
    public function broadcastAs()
    {
        return 'activity.updated';
    }
    // 
    public function broadcastWith()
    {
        return [
            'activity_data' => $this->activity,
        ];
    }
}
