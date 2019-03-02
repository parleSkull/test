<?php

namespace App\Models\Fund;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fund\Traits\Relationship\TransactionRelationship;
use App\Models\Fund\Traits\Attribute\TransactionAttribute;

class Transaction extends Model
{
    use TransactionRelationship,
        TransactionAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_id',
        'amount',
        'hash',
        'transaction_type',
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
