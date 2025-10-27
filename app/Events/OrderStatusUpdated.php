<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $order;
    public $oldStatus;

    public function __construct(Order $order, $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
    }

    public function broadcastOn()
    {
        // Private channel for specific user
        return new PrivateChannel('orders.' . $this->order->user_id);
    }

    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'new_status' => $this->order->status,
            'old_status' => $this->oldStatus,
        ];
    }
}
