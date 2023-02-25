<?php

namespace App\Models;

use App\Events\BidSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Class Bid
 *
 * @package App\Models
 */
class Bid extends Model
{
    use HasFactory;

    protected $table = "bids";

    /**
     * Get the user that owns the bid.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        parent::save($options);
        event(new BidSaved($this->user_id, $this->price));
    }
}
