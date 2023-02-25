<?php

namespace App\Listeners;

use App\Events\BidSaved;
use App\Models\User;
use App\Notifications\NewBidNotification;
use App\Services\BidService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Listeners Class SendNewBidNotification
 *
 * @package App\Listeners
 */
class SendNewBidNotification implements ShouldQueue
{
    /**
     * The name of the queue job should be sent to
     *
     * @var string|null
     */
    public $queue = 'notifications';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BidSaved  $event
     * @return void
     */
    public function handle(BidSaved $event)
    {
        $users = User::all();
        foreach ($users as $user) {
            $userLastBidPrice = $user->bids()->latest()->first();
            $user->notify(
                new NewBidNotification(
                    $event->latestBidPrice,
                    $userLastBidPrice ? $userLastBidPrice->price : 0
                )
            );
        }
    }
}
