<?php

namespace App\Events;

use App\Models\Public_content;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublicContentUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $public_content;
    public function __construct(Public_content $public_content)
    {
        $this->public_content = $public_content;
    }

    public function broadcastOn()
    {
        return new Channel('public_contents');
    }
    public function broadcastAs()
    {
        return 'public_content.updated';
    }
    public function broadcastWith()
    {
        return [
            'id' => $this->public_content->id,
            'content_type' => $this->public_content->content_type,
            'content' => $this->public_content->content
        ];
    }
}
