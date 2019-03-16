<?php

namespace App\Models\Fund\Traits\Scope;

/**
 * Class WalletScope.
 */
trait WalletScope
{
    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeOwner($query, $status)
    {
        return $query->where('user_id', $status);
    }
}
