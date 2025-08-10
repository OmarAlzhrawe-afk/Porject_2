<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SessionDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $session_id;
    protected $level_id;
    public function __construct($session_id, $level_id)
    {
        $this->session_id = $session_id;
        $this->level_id = $level_id;
    }

    public function broadcastOn()
    {
        return new Channel('subject-deleted');
    }
    public function broadcastWith()
    {
        return [
            'session_id' => $this->session_id,
            'level_id' => $this->level_id,
        ];
    }
}
