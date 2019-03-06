<?php

namespace App\Events\Frontend\Loan;

use App\Models\Loan\LoanContract;
use Illuminate\Queue\SerializesModels;

class LoanContractDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $loanContract;

    /**
     * Create a new event instance.
     *
     * @param LoanContract $loanContract
     */
    public function __construct(LoanContract $loanContract)
    {
        $this->loanContract = $loanContract;
    }
}
