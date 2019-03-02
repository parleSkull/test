<?php

namespace App\Models\Loan\Traits\Relationship;

use App\Models\Auth\User;

/**
 * Class LoanOfferRelationship.
 */
trait LoanOfferRelationship
{
    /**
     * User
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
