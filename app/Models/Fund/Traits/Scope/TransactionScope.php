<?php

namespace App\Models\Fund\Traits\Scope;

/**
 * Class TransactionScope.
 */
trait TransactionScope
{
    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeEWallet($query, $status)
    {
        return $query->where('wallet_id', $status);
    }
}
