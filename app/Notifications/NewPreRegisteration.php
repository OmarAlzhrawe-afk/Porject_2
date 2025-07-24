<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPreRegisteration extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => "you have New Pre_Registeration Order"
        ];
    }
    public function toBroadcast($notifiable)
    {
        return [
            'title' => "you have New Pre_Registeration Order"
        ];
    }
}
