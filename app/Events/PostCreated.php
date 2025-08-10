<?php

namespace App\Events;

use App\Models\School_post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $post;
    public function __construct(School_post $post)
    {
        $this->post = $post;
    }

    public function broadcastOn()
    {
        return new Channel('posts');
    }
    public function broadcastAs()
    {
        return 'post.added';
    }
    public function broadcastWith()
    {
        return [
            'title' => $this->post->title,
            'description' => $this->post->description,
            'post_type' => $this->post->post_type,
            'file_url' => $this->post->file_url,
            'is_public' => $this->post->is_public
        ];
    }
}
