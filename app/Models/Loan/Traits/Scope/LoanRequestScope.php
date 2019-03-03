<?php

namespace App\Models\Loan\Traits\Scope;

/**
 * Class LoanRequestScope.
 */
trait LoanRequestScope
{
    /**
     * @param $query
     * @param bool granted
     *
     * @return mixed
     */
    public function scopeGranted($query, $granted = true)
    {
        return $query->where('granted', $granted);
    }
}
