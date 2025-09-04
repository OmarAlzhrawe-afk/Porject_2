<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EducationContentNotification extends Notification
{
    use Queueable;
    protected $homwork;
    public function __construct($homwork)
    {
        $this->homwork = $homwork;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase()
    {
        return [
            'title' => 'Enrolling homwork Notification',
            'homwork' => $this->homwork,
        ];
    }
    public function toBroadcast()
    {
        return [
            'title' => 'Enrolling homwork Notification',
            'homwork' => $this->homwork,
        ];
    }
}
