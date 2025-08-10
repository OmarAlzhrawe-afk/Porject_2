<?php

namespace App\Events;

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EducationLevelDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $educationLevelId;

    public function __construct($educationLevelId)
    {
        $this->educationLevelId = $educationLevelId;
    }

    public function broadcastOn()
    {
        return new Channel('education-levels');
    }

    public function broadcastAs()
    {
        return 'education-level.deleted';
    }
}
