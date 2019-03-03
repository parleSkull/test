<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loan\Traits\Relationship\LoanRequestRelationship;
use App\Models\Loan\Traits\Scope\LoanRequestScope;
use App\Models\Loan\Traits\Attribute\LoanRequestAttribute;

class LoanRequest extends Model
{
    use SoftDeletes,
        LoanRequestRelationship,
        LoanRequestScope,
        LoanRequestAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'present_value',
        'period_type',
        'number_of_periods',
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
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['api_self_link'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'granted' => 'boolean'
    ];
}
