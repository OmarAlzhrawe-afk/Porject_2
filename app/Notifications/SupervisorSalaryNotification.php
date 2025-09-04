<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupervisorSalaryNotification extends Notification
{
    use Queueable;
    protected $salary;
    public function __construct($salary)
    {
        $this->salary = $salary;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase()
    {
        return [
            'title' => 'Salary Redy Notification',
            'data' =>  $this->salary
        ];
    }
    public function toBroadcast()
    {
        return [
            'title' => 'Salary Redy Notification',
            'salary' => $this->salary,
        ];
    }
}
