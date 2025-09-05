<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SalaryReadyNotification extends Notification
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
            'title' => 'Your Salary Ready',
            'message' => 'Your Salary Ready and This with BaseSalary : ' . $this->salary->Base_salary .
                '\n bonus : ' . $this->salary->bonus .
                '\n deducations : ' . $this->salary->deductions
            // 'data' =>  $this->salary
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Your Salary Ready',
            'message' => "Your Salary Ready and This with\n BaseSalary : " . $this->salary->Base_salary .
                "\n bonus : " . $this->salary->bonus .
                "\n deducations : " . $this->salary->deductions
            // 'data' =>  $this->salary
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

/**
 * 
 * 
  
 */
