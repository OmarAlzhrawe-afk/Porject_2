<?php

namespace App\Events;

use App\Models\Cultural_book;
use App\Models\Education_level as ModelsEducation_level;
use App\Models\Subject;
use App\Models\Text_book;
use Education_level;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $text_book;
    public $type;
    public function __construct($text_book, $type)
    {
        $this->text_book = $text_book;
        $this->type = $type;
    }
    public function broadcastOn()
    {
        return new Channel('books');
    }
    public function broadcastAs()
    {
        return 'book.created';
    }
    // 
    public function broadcastWith()
    {
        return [
            'type' => $this->type,
            'book_id' => $this->text_book->id,
            'book_data' => $this->text_book,
            // 'subject_id' => Subject::where('id', $this->text_book->subject_id)->value('name'),
            // 'education_level_id' =>  ModelsEducation_level::where('id', $this->text_book->education_level_id)->value('name'),
            // 'title' => $this->text_book->title,
            // 'total_quantity' => $this->text_book->total_quantity,
            // 'sold_quantity' => $this->text_book->sold_quantity,
            // 'price' => $this->text_book->price,
            // 'available_quantity' => $this->text_book->available_quantity
        ];
    }
}
