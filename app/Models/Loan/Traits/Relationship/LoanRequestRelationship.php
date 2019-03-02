<?php

namespace App\Models\Loan\Traits\Relationship;

use App\Models\Auth\User;

/**
 * Class LoanRequestRelationship.
 */
trait LoanRequestRelationship
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
