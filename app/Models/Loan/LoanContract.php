<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loan\Traits\Scope\LoanContractScope;

class LoanContract extends Model
{
    use SoftDeletes,
        LoanContractScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'consumer_id',
        'investor_id',
        'deal_origin_id',
        'deal_origin_type',
        'present_value',
        'period_type',
        'rate_per_period',
        'number_of_periods',
        'algorithm_type',
        'repayment_value',
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];
}
