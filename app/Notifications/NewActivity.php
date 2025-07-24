<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewActivity extends Notification
{
    use Queueable;
    protected $activity;
    public function __construct($activity)
    {
        $this->activity = $activity;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'New activity Notification',
            'activity' =>  $this->activity
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'New activity Notification',
            'activity' => $this->activity,

        ];
    }
}
