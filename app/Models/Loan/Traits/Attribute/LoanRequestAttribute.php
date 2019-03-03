<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 2/25/2019
 * Time: 20:48
 */

namespace App\Models\Loan\Traits\Attribute;

trait LoanRequestAttribute{
    /**
     * @return string
     */
    public function getApiSelfLinkAttribute()
    {
        return url("api/loan-requests/{$this->id}");
    }
}
