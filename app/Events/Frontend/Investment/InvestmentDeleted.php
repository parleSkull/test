<?php

namespace App\Events\Frontend\Investment;

use App\Models\Investment\Investment;
use Illuminate\Queue\SerializesModels;

class InvestmentDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $investment;

    /**
     * Create a new event instance.
     *
     * @param Investment $investment
     */
    public function __construct(Investment $investment)
    {
        $this->investment = $investment;
    }
}
