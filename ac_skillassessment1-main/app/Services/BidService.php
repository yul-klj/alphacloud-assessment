<?php

namespace App\Services;

use App\Models\Bid;

/**
 * Service Class BidService
 *
 * @package App\Services
 */
class BidService
{
    /**
     * Get highest bid
     *
     * @return string
     */
    public function getHighestBid()
    {
        return Bid::max('price');
    }

    /**
     * Create bid
     *
     * @param integer $user_id user id that bid
     * @param float   $price   price that the user bid
     *
     * @return Bid
     */
    public function createBid($user_id, $price)
    {
        $bid = new Bid();
        $bid->user_id = $user_id;
        $bid->price = $price;
        $bid->save();

        return $bid;
    }
}
