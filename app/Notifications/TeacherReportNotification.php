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
    public function todatabase()
    {
        return [
            'type' => ' New admin,supervisor Notification',
            'message' => ' monthly Teachers  Report',
            'reporturl' =>  $this->reporturl
        ];
    }
    public function toBroadcast()
    {

        return [
            'type' => ' New admin,supervisor Notification',
            'message' => ' monthly Teachers  Report',
            'reporturl' =>  $this->reporturl
        ];
    }
}
