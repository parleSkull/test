<?php

namespace App\Models\Fund;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fund\Traits\Relationship\WalletRelationship;
use App\Models\Fund\Traits\Scope\WalletScope;

class Wallet extends Model
{
    use SoftDeletes,
        WalletRelationship,
        Uuid,
        WalletScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_uuid',
        'balance',
    ];
}
