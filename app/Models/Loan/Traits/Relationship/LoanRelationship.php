<?php

namespace App\Models\Loan\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Loan\LoanPayment;

/**
 * Class LoanRelationship.
 */
trait LoanRelationship
{
    /**
     * User
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * LoanPayments
     * @return mixed
     */
    public function loan_payments()
    {
        return $this->hasMany(LoanPayment::class);
    }
}
