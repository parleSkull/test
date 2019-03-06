<?php

namespace App\Models\Loan\Traits\Scope;

/**
 * Class LoanContractScope.
 */
trait LoanContractScope
{
    /**
     * @param $query
     * @param string $status
     *
     * @return mixed
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @param $userId
     *
     * @return mixed
     */
    public function scopeOfUser($query, $userId)
    {
        return $query->where('consumer_id', $userId)->orWhere('investor_id', $userId);
    }
}
