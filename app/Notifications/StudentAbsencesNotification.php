<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAbsencesNotification extends Notification
{
    use Queueable;

    protected $absence;
    public function __construct($absence)
    {
        $this->absence = $absence;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'type' => 'Student Absence Notification',
            'data' => $this->absence
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'Student Absence Notification',
            'data' => $this->absence
        ];
    }
}
