<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Events Class BidSaved
 *
 * @package App\Events
 */
class BidSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId, $latestBidPrice;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $latest_bid_price)
    {
        $this->userId = $user_id;
        $this->latestBidPrice = $latest_bid_price;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
