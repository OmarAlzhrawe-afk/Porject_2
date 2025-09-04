<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;

    protected $post;
    public function __construct($post)
    {
        $this->post = $post;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'title' => 'Post',
            'message' => 'there Are New Post',
            // 'data' => $this->post
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Post',
            'message' => 'there Are New Post',
        ]);
    }
    public function broadcastOn()
    {
        return new Channel('school-channel');
    }
    public function broadcastAs()
    {
        return 'new-notification';
    }
}
