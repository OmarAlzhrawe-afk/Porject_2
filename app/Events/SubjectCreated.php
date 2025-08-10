<?php

namespace App\Events;

use App\Models\Subject;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubjectCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $subject;
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }
    public function broadcastOn()
    {
        return new Channel('subjects');
    }
    public function broadcastAs()
    {
        return 'subjects.created';
    }
    // 
    public function broadcastWith()
    {
        return [
            'id' => $this->subject->id,
            'name' => $this->subject->name,
            // 'level_id' => $this->subject,
        ];
    }
}
