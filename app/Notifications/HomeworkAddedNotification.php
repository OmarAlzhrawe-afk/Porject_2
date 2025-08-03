<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HomeworkAddedNotification extends Notification
{
    use Queueable;
    protected $education_content;
    public function __construct($education_content)
    {
        $this->education_content = $education_content;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Enrolling education_content Notification',
            'education_content' => $this->education_content,
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Enrolling education_content Notification',
            'education_content' => $this->education_content,
        ];
    }
}
