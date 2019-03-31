<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:51
// */
//
//namespace App\Models\MobileMoney\mtn\Service;
//
////import java.util.LinkedHashMap;
////import java.util.Map;
////
////import org.csapi.www.schema.momopayment.data.v1_0.NamedParameter;
////import org.csapi.www.schema.momopayment.data.v1_0.NamedParameterList;
////import org.csapi.www.schema.momopayment.data.v1_0.Result;
//
//use App\Models\MobileMoney\mtn\Model\RequestPaymentCompleRequest;
//use App\Models\MobileMoney\mtn\Model\RequestPaymentCompletedResponse;
//use App\Models\MobileMoney\mtn\Model\RequestPaymentResponse;
//use App\Models\MobileMoney\mtn\Common\Common;
//use App\Models\MobileMoney\mtn\Common\MoMoConstant;
//use http\Exception;
//use Illuminate\Support\Arr;
//
//class RequestPaymentCompleteService
//{
////private static  LinkedHashMap<String,RequestPaymentCompleRequestBean> responseMap=new LinkedHashMap<String,RequestPaymentCompleRequestBean>();
//    private static $responseMap = [];
//
//    public static function requestPaymentCompleted(RequestPaymentCompleRequest $paymentCompleteRequest,RequestPaymentCompletedResponse $paymentCompleteResponse)
//    {
//        try
//        {
//            self::setReqPaymentCompletedResponse($paymentCompleteResponse);
//            $processingNo = $paymentCompleteRequest->ProcessingNumber;
//
//            Arr::add(self::$responseMap, $processingNo, $paymentCompleteRequest);
//
//        }
//        catch(Exception $e)
//        {
////            e.printStackTrace ();
//        }
//    }
//
//    public static function setReqPaymentCompletedResponse(RequestPaymentCompletedResponse $paymentCompleteResponse)
//    {
//        $result = new Result();
//        $result->ResultCode = MoMoConstant::PAYMENT_COMPLETE_SUCCESS ;
//        $result->ResultDescription = MoMoConstant::PAYMENT_COMPLETE_SUCCESS_DESC ;
//
//        $paymentCompleteResponse->LocalResult = $result ;
//        $paramList = new NamedParameterList();
//        $param = new  NamedParameter[MoMoConstant::ONE]; //NamedParameter[]
//        $param[MoMoConstant.ZERO] = self::setparameters(MoMoConstant::EXT_RESPONSE_RESULT, MoMoConstant::PAYMENT_COMPLETE_SUCCESS_DESC);
//        $paramList->Item = $param;
//        $paymentCompleteResponse->LocalExtensionInfo = paramList;
//    }
//
//    public static function setparameters($name, $value): NamedParameter
//    {
//        $param = new NamedParameter();
//        $param->setKey($name);
//        $param->setValue($value);
//
//        return $param;
//    }
//
////@SuppressWarnings("rawtypes")
//    public static function queryPaymentCompleteResponse($processingNumber,RequestPaymentResponse $res)
//    {
//        if(Common::checkNullorEmpty ( $processingNumber ) && sizeof(self::$responseMap) != 0)
//        {
//            $resComplete = self::$responseMap[$processingNumber]; //RequestPaymentCompleRequest
//
//            if(!Common::checkNull ( $resComplete ))
//            {
//                $res->ProcessingNumber = $processingNumber ;
//                $res->StatusCode = $resComplete->StatusCode;
//                $res->StatusDesc = $resComplete->StatusDesc;
//            }
//        }
//    }
//}
