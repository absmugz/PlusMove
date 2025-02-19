<?php

namespace App\Events;

use App\Models\Delivery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class DeliveryUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $delivery;

    /**
     * Create a new event instance.
     */
    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new Channel('deliveries'); // Public channel
    }

    /**
     * Get the event name.
     */
    public function broadcastAs()
    {
        return 'delivery.updated';
    }

    /**
     * Get the data to send with the event.
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->delivery->id,
            'status' => $this->delivery->status,
            'driver_id' => $this->delivery->driver_id,
            'city_id' => $this->delivery->city_id,
            'assigned_at' => $this->delivery->assigned_at,
            'latitude' => $this->delivery->latitude,
            'longitude' => $this->delivery->longitude,
            'updated_at' => $this->delivery->updated_at,
        ];
    }
}
