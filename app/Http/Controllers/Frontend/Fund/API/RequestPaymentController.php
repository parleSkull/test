<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:39
 */

namespace App\Http\Controllers\Frontend\Fund\API;

use App\Models\MobileMoney\mtn\Common\ConfigurationReader;
use App\Http\Controllers\Controller;
use App\Models\MobileMoney\Mtn\Util\RequestPaymentClientFactory;
use App\Models\MobileMoney\Mtn\Util\Type\ProcessRequest;
use App\Models\MobileMoney\Mtn\Util\Type\RequestSoapHeader;
use App\Repositories\Frontend\Fund\MTN\RequestPaymentRequestRepository;
use App\Repositories\Frontend\Fund\MTN\RequestPaymentResponseRepository;
use Illuminate\Http\Request;

class RequestPaymentController extends Controller
{
    /**
     * @var RequestPaymentRequestRepository
     */
    protected $requestPaymentRequestRepository;

    /**
     * @var RequestPaymentResponseRepository
     */
    protected $requestPaymentResponseRepository;

    /**
     * RequestPaymentController constructor.
     *
     * @param RequestPaymentRequestRepository $requestPaymentRequestRepository
     * @param RequestPaymentResponseRepository $requestPaymentResponseRepository
     */
    public function __construct(RequestPaymentRequestRepository $requestPaymentRequestRepository,
                                RequestPaymentResponseRepository $requestPaymentResponseRepository)
    {
        $this->requestPaymentRequestRepository = $requestPaymentRequestRepository;
        $this->requestPaymentResponseRepository = $requestPaymentResponseRepository;
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function requestPayment(Request $request){}
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
