<?php

namespace App\Events\Frontend\Loan;

use App\Models\Loan\LoanRequest;
use Illuminate\Queue\SerializesModels;

class LoanRequestDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $loanRequest;

    /**
     * Create a new event instance.
     *
     * @param LoanRequest $loanRequest
     */
    public function __construct(LoanRequest $loanRequest)
    {
        $this->loanRequest = $loanRequest;
    }
}
