<?php

namespace App\Models\Investment\Traits\Relationship;

use App\Models\Investment\Investment;

/**
 * Class InvestmentPaymentRelationship.
 */
trait InvestmentPaymentRelationship
{
    /**
     * Investment
     * @return mixed
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
