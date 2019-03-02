<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanContract extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrower_id',
        'lender_id',
        'contractable_id',
        'contractable_type',
        'present_value',
        'rate_per_period',
        'number_of_periods',
        'algorithm_type',
        'payment_amount',
        'transactions',
        'completed'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
        'transactions' => 'json'
    ];
}
