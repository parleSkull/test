<?php

namespace App\Models\MobileMoney\Mpesa\C2B;

use Illuminate\Database\Eloquent\Model;

class STKSuccessResponse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MerchantRequestID',
        'CheckoutRequestID',
        'ResponseDescription',
        'ResponseCode',
        'CustomerMessage'
    ];

    /**
     * Get the post's image.
     */
    public function s_t_k_request()
    {
        return $this->morphOne(STKRequest::class, 'response');
    }
}
