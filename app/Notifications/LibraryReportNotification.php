<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibraryReportNotification extends Notification
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
            'title' => ' New Library  Notification',
            'message' => ' monthly Library  Report',
            'reporturl' =>  $this->reporturl
        ];
    }
    public function toBroadcast()
    {
        return [
            'title' => ' New Library  Notification',
            'message' => ' monthly Library  Report',
            'reporturl' =>  url($this->reporturl)
        ];
    }
}
