<?php

namespace App\Notifications;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MarkNotification extends Notification
{
    use Queueable;
    protected $mark;
    public function __construct($mark)
    {
        $this->mark = $mark;
    }
    public function getTeacherName($mark)
    {
        $TeacherRecord = Teacher::find($mark->teacher_id);
        $TeacherName = User::find($TeacherRecord->user_id)->value('name');
        return $TeacherName;
    }
    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function todatabase()
    {
        return [
            'title' => 'Marks Notfication',
            'Message' => 'Adding mark for you By ' . $this->getTeacherName($this->mark),
            // 'mark' => $this->mark,
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Marks Notfication',
            'Message' => 'Adding mark for you By ' . $this->getTeacherName($this->mark),
            // 'mark' => $this->mark,
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
