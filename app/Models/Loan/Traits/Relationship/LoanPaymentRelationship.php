<?php

namespace App\Models\Loan\Traits\Relationship;

use App\Models\Loan\Loan;

/**
 * Class LoanPaymentRelationship.
 */
trait LoanPaymentRelationship
{
    /**
     * Loan
     * @return mixed
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
