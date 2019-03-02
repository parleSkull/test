<?php

namespace App\Models\Fund;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fund\Traits\Relationship\WalletRelationship;

class Wallet extends Model
{
    use WalletRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'balance',
    ];
}
