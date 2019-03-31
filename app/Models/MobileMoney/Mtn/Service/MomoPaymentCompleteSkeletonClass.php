<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:50
// */
//
//namespace App\Models\MobileMoney\mtn\Service;
//
////import org.csapi.www.schema.momopayment.local.v1_0.RequestPaymentCompletedE;
////import org.csapi.www.schema.momopayment.local.v1_0.RequestPaymentCompletedResponse;
////import org.csapi.www.schema.momopayment.local.v1_0.RequestPaymentCompletedResponseE;
////import org.csapi.www.wsdl.momopayment.service.v1_0.MomoPaymentServiceSkeleton;
//
//use App\Models\MobileMoney\mtn\Model\RequestPaymentCompleRequest;
//use App\Models\MobileMoney\mtn\Model\RequestPaymentCompletedResponse;
//use http\Exception;
//
//class MomoPaymentCompleteSkeletonClass extends MomoPaymentServiceSkeleton
//{
//
//    public function requestPaymentCompleted(RequestPaymentCompletedE $requestPaymentCompleted0): RequestPaymentCompletedResponseE
//    {
//        $reqPayResponseE = new RequestPaymentCompletedResponseE();
//        $reqPayCom = new RequestPaymentCompleRequest();
//        $resCompResponse = new RequestPaymentCompletedResponse();
//
//        try
//        {
//            self::buildReqPaymentComplete($reqPayCom, $requestPaymentCompleted0);
//            RequestPaymentCompleteService::requestPaymentCompleted ( $reqPayCom,$resCompResponse );
//            $reqPayComResponse = buildRequestPaymentCompletedResponse($resCompResponse); //RequestPaymentCompletedResponse
//
//            $reqPayResponseE->setRequestPaymentCompletedResponse ( $reqPayComResponse );
//        }
//        catch(Exception $e)
//        {
////            e.printStackTrace ();
//        }
//
//        return $reqPayResponseE;
//    }
//
//    public static function buildRequestPaymentCompletedResponse(RequestPaymentCompletedResponse $resCompResponse): RequestPaymentCompletedResponse
//    {
//        $reqPayComResponse = new RequestPaymentCompletedResponse(); //RequestPaymentCompletedResponse
//
//        $reqPayComResponse->setResult ( $resCompResponse->getLocalResult () );
//        $reqPayComResponse->setExtensionInfo ( $resCompResponse->getLocalExtensionInfo () );
//
//        return $reqPayComResponse;
//    }
//
//    public static function buildReqPaymentComplete(RequestPaymentCompleRequest $reqPayCom, RequestPaymentCompletedE $requestPaymentCompleted0)
//    {
//        $reqPayCom->ProcessingNumber = $requestPaymentCompleted0->getRequestPaymentCompleted ()->getProcessingNumber () ;
//        $reqPayCom->StatusCode = $requestPaymentCompleted0->getRequestPaymentCompleted ()->getStatusCode () ;
//        $reqPayCom->StatusDesc = $requestPaymentCompleted0->getRequestPaymentCompleted ()->getStatusDesc () ;
//        $reqPayCom->ThirdPartyAcctRef = $requestPaymentCompleted0->getRequestPaymentCompleted ()->getThirdPartyAcctRef () ;
//        $reqPayCom->mOMTransactionID = $requestPaymentCompleted0->getRequestPaymentCompleted ()->getMOMTransactionID () ;
//    }
//}
