<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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
            'type' => 'New Book Loan Notification',
            'you Will Return the Book At ' =>  $this->RetriveDate
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => 'New Book Loan Notification',
            'you Will Return the Book At ' =>  $this->RetriveDate
        ];
    }
}
