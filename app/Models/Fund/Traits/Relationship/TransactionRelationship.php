<?php

namespace App\Models\Fund\Traits\Relationship;

use App\Models\Fund\Wallet;

/**
 * Class TransactionRelationship.
 */
trait TransactionRelationship
{
    /**
     * User
     * @return mixed
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
