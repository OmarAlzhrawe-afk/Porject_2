<?php

namespace App\Notifications;

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
    public function todatabase()
    {
        return [
            'type' => ' New financial  Notification',
            'message' => ' monthly financial  Report',
            'reporturl' =>  $this->reporturl
        ];
    }
    public function toBroadcast()
    {
        return [
            'type' => ' New financial  Notification',
            'message' => ' monthly financial  Report',
            'reporturl' =>  $this->reporturl
        ];
    }
}
