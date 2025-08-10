<?php

namespace App\Events;


use App\Models\Education_level;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EducationLevelCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $educationLevel;
    public function __construct(Education_level $level)
    {
        $this->educationLevel = $level;
    }
    public function broadcastOn()
    {
        return new Channel('education-levels');
    }
    public function broadcastAs()
    {
        return 'education-level.created';
    }
    // 
    public function broadcastWith()
    {
        return [
            'id' => $this->educationLevel->id,
            'name' => $this->educationLevel->name,
            'Acadimic_year' => $this->educationLevel->Acadimic_year,
            'description' => $this->educationLevel->description,
            'price' => $this->educationLevel->price,
            'supervisor_id' => $this->educationLevel->supervisor_id,
            'created_at' => $this->educationLevel->created_at->toDateTimeString(),
        ];
    }
}
