<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Loan\Traits\Relationship\LoanOfferRelationship;
use App\Models\Loan\Traits\Scope\LoanOfferScope;
use App\Models\Loan\Traits\Attribute\LoanOfferAttribute;

class LoanOffer extends Model
{
    use SoftDeletes,
        LoanOfferRelationship,
        LoanOfferScope,
        LoanOfferAttribute;

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
        'period_type',
        'algorithm_type',
        'repayment_value',
        'funded',
        'watchers',
        'accepted',
        'open'
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
        'accepted' => 'boolean',
        'funded' => 'boolean',
        'open' => 'boolean',
        'watchers' => 'json'
    ];
}
