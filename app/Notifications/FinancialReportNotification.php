<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinancialReportNotification extends Notification
{
    use Queueable;
    protected $reporturl;
    public function __construct($reporturl)
    {
        $this->reporturl = $reporturl;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }
    public function toDatabase()
    {
        return [
            'title' => ' New financial  Notification',
            'message' => ' monthly financial  Report',
            'reporturl' => url($this->reporturl)
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'New financial Notification',
            'message' => 'Monthly financial Report',
            'reporturl' => url($this->reporturl),
        ]);
    }
}
