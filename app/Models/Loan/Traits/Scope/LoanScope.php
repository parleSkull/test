<?php

namespace App\Models\Loan\Traits\Scope;

/**
 * Class LoanScope.
 */
trait LoanScope
{
    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeQueued($query, $status)
    {
        return $query->where('deal_status', $status);
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status)
    {
        return $query->where('deal_status', $status);
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeSettled($query, $status)
    {
        return $query->where('deal_status', $status);
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeDisputed($query, $status)
    {
        return $query->where('deal_status', $status);
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeApproved($query, $status)
    {
        return $query->where('deal_status', $status);
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeDeclined($query, $status)
    {
        return $query->where('deal_status', $status);
    }

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
