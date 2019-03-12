<?php

namespace App\Models\Investment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Investment\Traits\Relationship\InvestmentPaymentRelationship;

class InvestmentPayment extends Model
{
    use SoftDeletes,
        InvestmentPaymentRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'payment_number',
        'reinvestment_value',
        'service_fee',
        'beginning_balance',
        'interest_earned',
        'withdrawal',
        'ending_balance',
        'deal_status',
        'start_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'start_at'
    ];
}
