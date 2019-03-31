<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:45
 */

namespace App\Models\MobileMoney\mtn\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestPaymentResponse extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'processingNumber',
        'thirdPartyAcctRef',
        'senderID',
        'statusCode',
        'statusDesc',
        'mOMTransactionID'
    ];
}
