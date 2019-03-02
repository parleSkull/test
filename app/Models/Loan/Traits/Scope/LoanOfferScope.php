<?php

namespace App\Models\Loan\Traits\Scope;

/**
 * Class LoanOfferScope.
 */
trait LoanOfferScope
{
    /**
     * @param $query
     * @param bool $accepted
     *
     * @return mixed
     */
    public function scopeAccepted($query, $accepted = true)
    {
        return $query->where('accepted', $accepted);
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeOpen($query, $status = true)
    {
        return $query->where('open', $status);
    }

    /**
     * @param $query
     * @param bool $funded
     *
     * @return mixed
     */
    public function scopeFunded($query, $funded = true)
    {
        return $query->where('funded', $funded);
    }
}
