<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentProfileUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $studentprofile;
    public function __construct($studentprofile)
    {
        $this->studentprofile = $studentprofile;
    }
    public function broadcastOn()
    {
        return new Channel('activities');
    }
    public function broadcastAs()
    {
        return 'studentprofile.updated';
    }
    // 
    public function broadcastWith()
    {
        return [
            'student_profile_data' => $this->studentprofile,
        ];
    }
}
