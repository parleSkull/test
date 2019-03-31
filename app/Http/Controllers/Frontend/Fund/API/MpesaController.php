<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:39
 */

namespace App\Http\Controllers\Frontend\Fund\API;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Fund\STKRequestRepository;
use App\Services\MobileMoney\Mpesa\Laravel\Facades\STK;
use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MpesaController extends Controller
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
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function deposit(Request $request)
    {
        $stk_request = $this->stkRequestRepository->create(array_merge($request->only(
            'dueAmount',
            'msisdn'
        ), ['user_id' => $request->user()->id, 'user_uuid' => $request->user()->uuid]));

        $response = STK::request($stk_request->Amount)
            ->from($stk_request->PhoneNumber)
            ->usingAccount('staging')
            ->payAs(MpesaConstant::TRANSACTIONTYPE_CUSTOMER_PAYBILL_ONLINE)
            ->trackBy($stk_request->uuid)
            ->usingReference('SolventFund Investment', 'Deposit Funds')
            ->updateModel($stk_request)
            ->push();

        return $response;
    }
//    public function requestPayment(Request $request)
//    {
//        $spId = ConfigurationReader::getProperty('spId');
//        $spPswd = ConfigurationReader::getProperty('spPassword');
//        $serviceId = ConfigurationReader::getProperty('serviceId');
//        $bundleID = ConfigurationReader::getProperty('bundleID');
//        $timestamp = now()->format('YmdHms');
///*       SHA-256: spPassword = Base64(SHA-256(spId + Password + timeStamp)) OR spPassword = MD5(spId + Password + timeStamp) */
//        $spPassword = base64_encode(hash('sha256', $spId.$spPswd.$timestamp));
//
//        $request = $this->requestPaymentRequestRepository->fill(array_merge($request->only(
//            'DueAmount',
//            'MSISDNNum'
//        ), ['AcctBalance' => $request->user()->balance, 'AcctRef' => $request->user()->uuid, 'user_id' => $request->user()->id,
//            'spId' => $spId, 'spPassword' => $spPassword, 'bundleID' => $bundleID, 'timeStamp' => $timestamp]));
//
//        $soapHeaderObj = new RequestSoapHeader($spId, $spPassword, $serviceId, $bundleID, $timestamp);
//        $client = RequestPaymentClientFactory::factoryWithMiddleware(
//            ConfigurationReader::getProperty('REQPAYEMENTURL').'?WSDL', $soapHeaderObj);
//
//        $paramList = [];
//        foreach ($request->parameter as $key=>$value){
//            array_push($paramList, ['name' => $key, 'value' => $value]);
//        }
//        $response = $client->requestPayment(new ProcessRequest($request->spId, $paramList));
//
//        $resKeys = [];
//        $resVals = [];
//        foreach ($response->getReturn() as $item){
//            array_push($resKeys, $item->getName());
//            array_push($resVals, $item->getValue());
//        }
//
//        return array_combine($resKeys, $resVals);
//    }

//    public function queryResponsePayment(Request $request)
//    {
//        $processingNumber = $request->get('processingNumber');
//        $this->setRes ( new RequestPaymentResponse () );
//        RequestPaymentCompleteService::queryPaymentCompleteResponse ( $processingNumber, $this->res );
//        return "successRes";
//    }
}
