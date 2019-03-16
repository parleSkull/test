<?php

namespace App\Models\Fund;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fund\Traits\Relationship\TransactionRelationship;
use App\Models\Fund\Traits\Attribute\TransactionAttribute;
use App\Models\Fund\Traits\Scope\TransactionScope;

class Transaction extends Model
{
    use SoftDeletes,
        TransactionRelationship,
        TransactionAttribute,
        TransactionScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash',
        'wallet_id',
        'transaction_mode',
        'transaction_type',
        'amount',
        'pre_balance',
        'post_balance',
        'transaction_status',
        'accepted',
        'meta'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
        'meta' => 'json'
    ];
}
