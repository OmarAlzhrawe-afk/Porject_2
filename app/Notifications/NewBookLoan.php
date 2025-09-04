<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookLoan extends Notification
{
    use Queueable;
    protected $RetriveDate;
    public function __construct($RetriveDate)
    {
        $this->RetriveDate = $RetriveDate;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'title' => 'New Book Loan Notification',
            'you Will Return the Book At ' =>  $this->RetriveDate
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'New Book Loan Notification',
            'you Will Return the Book At ' =>  $this->RetriveDate

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
