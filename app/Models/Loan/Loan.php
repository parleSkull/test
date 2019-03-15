<?php

namespace App\Models\Loan;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loan\Traits\Relationship\LoanRelationship;
use App\Models\Loan\Traits\Scope\LoanScope;

class Loan extends Model
{
    use SoftDeletes,
        LoanRelationship,
        LoanScope,
        Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_uuid',
        'purpose',
        'alias',
        'requested_value',
        'interest_rate',
        'repayment_value',
        'interest_value',
        'deal_status',
        'number_of_payments'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'start_at',
        'due_at'
    ];
}
