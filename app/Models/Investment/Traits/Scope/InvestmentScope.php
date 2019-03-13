<?php

namespace App\Models\Investment\Traits\Scope;

/**
 * Class InvestmentScope.
 */
trait InvestmentScope
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
    public function scopeOwner($query, $status)
    {
        return $query->where('user_id', $status);
    }
}
