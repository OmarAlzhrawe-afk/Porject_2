<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublicContentDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $public_content_id;
    public function __construct($public_content_id)
    {
        $this->public_content_id = $public_content_id;
    }

    public function broadcastOn()
    {
        return new Channel('public_contents');
    }
    public function broadcastAs()
    {
        return 'public_content.deleted';
    }
}
