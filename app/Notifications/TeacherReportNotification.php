<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeacherReportNotification extends Notification
{
    use Queueable;
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
            'title' => 'new Report For Teachers',
            'message' => ' monthly Teachers  Report',
            'reporturl' => url($this->reporturl)
        ];
    }
    public function toBroadcast()
    {

        return [
            'title' => 'new Report For Teachers',
            'message' => ' monthly Teachers  Report',
            'reporturl' =>  url($this->reporturl)
        ];
    }
}
