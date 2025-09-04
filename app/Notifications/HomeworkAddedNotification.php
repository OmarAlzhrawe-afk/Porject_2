<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HomeworkAddedNotification extends Notification
{
    use Queueable;
    protected $home_work;
    public function __construct($home_work)
    {
        $this->home_work = $home_work;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'title' => 'Adding Homework',
            'home_work' => $this->home_work,
        ];
    }
    public function toBroadcast()
    {
        return [
            'title' => 'Adding Homework',
            'home_work' => $this->home_work,
        ];
    }
}
