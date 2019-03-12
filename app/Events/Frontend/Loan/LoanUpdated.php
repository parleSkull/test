<?php

namespace App\Events\Frontend\Loan;

use App\Models\Loan\Loan;
use Illuminate\Queue\SerializesModels;

class LoanUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $loanRequest;

    /**
     * Create a new event instance.
     *
     * @param Loan $loanRequest
     */
    public function __construct(Loan $loanRequest)
    {
        $this->loanRequest = $loanRequest;
    }
}
