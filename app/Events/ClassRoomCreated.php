<?php

namespace App\Events;

use App\Models\Class_room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClassRoomCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $class_room;
    public function __construct(Class_room $class_room)
    {
        $this->class_room = $class_room;
    }
    public function broadcastOn()
    {
        return new Channel('education-levels');
    }
    public function broadcastAs()
    {
        return 'class_room.created';
    }
    // 
    public function broadcastWith()
    {
        return [
            'id' => $this->class_room->id,
            'education_level_id' => $this->class_room->education_level_id,
            'name' => $this->class_room->name,
            'capacity' => $this->class_room->capacity,
            'current_count' => $this->class_room->current_count,
            'floor' => $this->class_room->floor,
        ];
    }
}
