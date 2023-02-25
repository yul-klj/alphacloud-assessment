<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Notification Class NewBidNotification
 *
 * @package App\Notifications
 */
class NewBidNotification extends Notification
{
    use Queueable;

    public $latestBidPrice, $userLastBidPrice;

    /**
     * Create a new notification instance.
     *
     * @param float $latestBidPrice
     * @param float $userLastBidPrice
     *
     * @return void
     */
    public function __construct($latestBidPrice, $userLastBidPrice)
    {
        $this->latestBidPrice = $latestBidPrice;
        $this->userLastBidPrice = $userLastBidPrice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            "latest_bid_price" => number_format($this->latestBidPrice, 2, '.', ''),
	        "user_last_bid_price" => number_format($this->userLastBidPrice, 2, '.', '')
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
