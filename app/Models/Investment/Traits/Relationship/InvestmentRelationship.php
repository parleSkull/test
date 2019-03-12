<?php

namespace App\Models\Investment\Traits\Relationship;

use App\Models\Auth\User;
use App\Models\Investment\InvestmentPayment;

/**
 * Class InvestmentRelationship.
 */
trait InvestmentRelationship
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
     * InvestmentPayments
     * @return mixed
     */
    public function investment_payments()
    {
        return $this->hasMany(InvestmentPayment::class);
    }
}
