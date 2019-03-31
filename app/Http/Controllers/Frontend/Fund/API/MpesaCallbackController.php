<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:39
 */

namespace App\Http\Controllers\Frontend\Fund\API;

use App\Http\Controllers\Controller;
use App\Models\MobileMoney\Mpesa\C2B\STKSuccessResponse;
use App\Repositories\Frontend\Fund\STKRequestRepository;
use App\Services\MobileMoney\Mpesa\Laravel\Facades\STK;
use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function PHPSTORM_META\type;

class MpesaCallbackController extends Controller
{
    /**
     * @var STKRequestRepository
     */
    protected $stkRequestRepository;

    /**
     * RequestPaymentController constructor.
     *
     * @param STKRequestRepository $stkRequestRepository
     */
    public function __construct(STKRequestRepository $stkRequestRepository)
    {
        $this->stkRequestRepository = $stkRequestRepository;
    }

    /**
     * Use this function to process the STK push request callback
     * @param Request $request
     * @return string
     */
    public function processSTKPushRequestCallback(Request $request){
//        $callbackJSONData=file_get_contents('php://input');
//        $callbackData=json_decode($callbackJSONData);
        $callbackData = $request->json('Body');

        $resultCode=Arr::get($callbackData, 'stkCallback.ResultCode');
        $resultDesc=Arr::get($callbackData, 'stkCallback.ResultDesc');
        $merchantRequestID=Arr::get($callbackData, 'stkCallback.MerchantRequestID');
        $checkoutRequestID=Arr::get($callbackData, 'stkCallback.CheckoutRequestID');

        $callbackMetadata=Arr::get($callbackData, 'stkCallback.CallbackMetadata.Item');
        $amount=Arr::get($callbackMetadata[0], 'Value', null);
        $mpesaReceiptNumber=Arr::get($callbackMetadata[1], 'Value', null);
        $balance=Arr::get($callbackMetadata[2], 'Value', null);
        $transactionDate=Arr::get($callbackMetadata[3], 'Value', null);
        $phoneNumber=Arr::get($callbackMetadata[4], 'Value', null);

        $result=[
            "resultDesc"=>$resultDesc,
            "resultCode"=>$resultCode,
            "merchantRequestID"=>$merchantRequestID,
            "checkoutRequestID"=>$checkoutRequestID,
            "amount"=>$amount,
            "mpesaReceiptNumber"=>$mpesaReceiptNumber,
            "balance"=>$balance,
            "transactionDate"=>$transactionDate,
            "phoneNumber"=>$phoneNumber
        ];

//        $request->query('uuid');
        $stkResponse = STKSuccessResponse::query()->where([
            ['MerchantRequestID', '=', $merchantRequestID],
            ['CheckoutRequestID', '=', $checkoutRequestID],
        ])->first();

        if ($stkResponse->s_t_k_request->s_t_k_result){
            $resultObj = $stkResponse->s_t_k_request->s_t_k_result->update($result);
            $resultObj = $stkResponse->s_t_k_request->s_t_k_result;
        }else{
            $resultObj = $stkResponse->s_t_k_request->s_t_k_result()->create($result);
        }
        return $resultObj;
    }
}
