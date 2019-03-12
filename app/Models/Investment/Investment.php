<?php

namespace App\Models\Investment;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Investment\Traits\Relationship\InvestmentRelationship;
use App\Models\Investment\Traits\Scope\InvestmentScope;

class Investment extends Model
{
    use SoftDeletes,
        InvestmentRelationship,
        InvestmentScope,
        Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'initial_value',
        'current_value',
        'interest_rate'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'start_at',
        'next_payment_at'
    ];
}
