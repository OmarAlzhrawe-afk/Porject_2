<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivityEnrollNotification extends Notification
{
    use Queueable;
    protected $transaction;
    protected $activity;
    public function __construct($transaction, $activity)
    {
        $this->transaction = $transaction;
        $this->activity = $activity;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase()
    {
        return [
            'title' => 'Enrolling Activity Notification',
            'activity' => $this->activity,
            'transaction' => $this->transaction
        ];
    }
    public function toBroadcast()
    {
        return [
            'title' => 'Enrolling Activity Notification',
            'activity' => $this->activity,
            'transaction' => $this->transaction
        ];
    }
}
