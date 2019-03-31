<?php

namespace App\Models\MobileMoney\Mpesa\C2B;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class STKRequest extends Model
{
    use SoftDeletes,
        Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_uuid',
        'BusinessShortCode',
        'Timestamp',
        'TransactionType',
        'Amount',
        'PhoneNumber',
        'AccountReference',
        'response_id',
        'response_type'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public function getUuidName(){
        return 'uuid';
    }

    /**
     * Get all of the owning response-like models.
     */
    public function response()
    {
        return $this->morphTo();
    }

    public function s_t_k_result()
    {
        return $this->hasOne(STKResult::class);
    }
}
