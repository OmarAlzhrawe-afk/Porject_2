<?php

namespace App\Events;

use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SessionAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $session;
    public function __construct(Class_session $session)
    {
        $this->session = $session;
    }

    public function broadcastOn()
    {
        return new Channel('session-added');
    }
    public function broadcastAs()
    {
        return 'session.added';
    }
    public function broadcastWith()
    {
        return [
            'teacher_name' => Teacher::where('id', $this->session->teacher_id)
                ->first()
                ->with('user')
                ->name ?? NULL,
            'class_room_name' => Class_room::where('id', $this->session->class_room_id)->value('name'),
            'subject_id' => Subject::where('id', $this->session->subject_id)->value('name'),
            'session_day' => $this->session->session_day,
            'start_time' => $this->session->start_time,
            'end_time' => $this->session->end_time
        ];
    }
}
