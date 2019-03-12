<?php

namespace App\Events\Frontend\Loan;

use App\Models\Loan\LoanPayment;
use Illuminate\Queue\SerializesModels;

class LoanPaymentUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $loanPayment;

    /**
     * Create a new event instance.
     *
     * @param LoanPayment $loanPayment
     */
    public function __construct(LoanPayment $loanPayment)
    {
        $this->loanPayment = $loanPayment;
    }
}
