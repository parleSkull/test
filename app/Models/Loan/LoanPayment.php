<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loan\Traits\Relationship\LoanPaymentRelationship;

class LoanPayment extends Model
{
    use SoftDeletes,
        LoanPaymentRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loan_id',
        'payment_number',
        'payment_value',
        'pre_balance',
        'post_balance'
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
