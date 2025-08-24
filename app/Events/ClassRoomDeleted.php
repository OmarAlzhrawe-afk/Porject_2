<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClassRoomDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $class_id;
    public $level_id;

    public function __construct($class_id, $level_id)
    {
        $this->class_id = $class_id;
        $this->level_id = $level_id;
    }
    public function broadcastOn()
    {
        return new Channel('class_rooms');
    }
    public function broadcastAs()
    {
        return 'class_rooms.deleted';
    }
}
