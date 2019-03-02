<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loan\Traits\Relationship\LoanRequestRelationship;

class LoanRequest extends Model
{
    use SoftDeletes,
        LoanRequestRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'present_value',
        'rate_per_period',
        'number_of_periods',
        'algorithm_type',
        'payment_amount',
        'interested',
        'granted'
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
        'granted' => 'boolean',
        'interested' => 'json'
    ];
}
