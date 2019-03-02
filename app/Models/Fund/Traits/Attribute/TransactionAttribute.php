<?php

namespace App\Models\Fund\Traits\Attribute;

/**
 * Trait TransactionAttribute.
 */
trait TransactionAttribute
{
    /**
     * @return string
     */
    public function getAmountWithSignAttribute()
    {
        return in_array($this->type, ['Deposit', 'Refund'])
            ? '+' . $this->amount
            : '-' . $this->amount;
    }
}
