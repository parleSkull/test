<?php

namespace App\Events\Frontend\Loan;

use App\Models\Loan\LoanOffer;
use Illuminate\Queue\SerializesModels;

class LoanOfferDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $loanOffer;

    /**
     * Create a new event instance.
     *
     * @param LoanOffer $loanOffer
     */
    public function __construct(LoanOffer $loanOffer)
    {
        $this->loanOffer = $loanOffer;
    }
}
