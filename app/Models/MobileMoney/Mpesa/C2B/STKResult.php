<?php

namespace App\Models\MobileMoney\Mpesa\C2B;

use Illuminate\Database\Eloquent\Model;

class STKResult extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        's_t_k_request_id',
        'merchantRequestID',
        'checkoutRequestID',
        'resultCode',
        'resultDesc',
        'amount',
        'mpesaReceiptNumber',
        'balance',
        'transactionDate',
        'phoneNumber'
    ];

    public function s_t_k_request()
    {
        return $this->belongsTo(STKRequest::class);
    }
}
