<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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
            'type' => 'Session Notification',
            'data' => $this->post
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Session Notification',
            'data' => $this->post
        ];
    }
}
