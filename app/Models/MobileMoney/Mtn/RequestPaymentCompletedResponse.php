<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:44
 */

namespace App\Models\MobileMoney\mtn\Model;

//import org.csapi.www.schema.momopayment.data.v1_0.NamedParameterList;
//import org.csapi.www.schema.momopayment.data.v1_0.Result;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestPaymentCompletedResponse extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'localResult',
        'localExtensionInfo',
        'localExtensionInfoTracker'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'localExtensionInfoTracker' => 'boolean'
    ];
}
