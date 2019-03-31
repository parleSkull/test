<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:40
 */

namespace App\Models\MobileMoney\mtn\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\MobileMoney\mtn\Common\Common;
use App\Models\MobileMoney\mtn\Common\ConfigurationReader;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositMobileMoneyRequest extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'msisdn',
        'spId',
        'spPassword',
        'bundleId',
        'serviceId',
        'timeStamp',
        'processingNumber',
        'senderId',
        'prefLang',
        'opCoID',
        'amount',
        'narration',
        'currCode',
        'imsiNum',
        'orderDateTime',
        'statusCode'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'timeStamp',
        'deleted_at'
    ];
}
