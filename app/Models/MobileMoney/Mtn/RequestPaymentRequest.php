<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:44
 */

namespace App\Models\MobileMoney\mtn\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RequestPaymentRequest extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /* System Info */
        'user_id',

        /* Header Information */
        'spId',
        'spPassword',
        'bundleID',
        'serviceId',
        'timeStamp',

        /* Body Information */
        /*'serviceId' for body */
        'DueAmount',
        'MSISDNNum',
        'ProcessingNumber',
        'AcctRef',
        'AcctBalance',
        'MinDueAmount',
        'Narration',
        'PrefLang',
        'OpCoID',
        'CurrCode',
        'senderId',
        'transactionId'
    ];

    function getParameterAttribute(){
        return $this->only(['DueAmount', 'MSISDNNum', 'ProcessingNumber', 'serviceId', 'AcctRef', 'AcctBalance',
            'MinDueAmount', 'Narration', 'PrefLang', 'OpCoID', 'CurrCode']);
    }
}
