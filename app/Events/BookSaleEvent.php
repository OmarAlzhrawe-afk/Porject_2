<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookSaleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sale;
    // public $type;
    public function __construct($sale)
    {
        $this->sale = $sale;
        // $this->type = $type;
    }
    public function broadcastOn()
    {
        return new Channel('books');
    }
    public function broadcastAs()
    {
        return 'book.sale';
    }
    // 
    public function broadcastWith()
    {
        return [
            'sale_data' => $this->sale,
        ];
    }
}
