<?php

namespace App\Models\Fund\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Fund\Transaction;

/**
 * Class WalletRelationship.
 */
trait WalletRelationship
{
    /**
     * Transactions
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * User
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
