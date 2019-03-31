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
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse;
//
//use App\Models\MobileMoney\mtn\Model\RequestPaymentRequest;
//use App\Models\MobileMoney\mtn\Model\RequestPaymentResponse;
//use App\Models\MobileMoney\mtn\Common\Common;
//use App\Models\MobileMoney\mtn\Common\ErrorCodeConstants;
//use App\Models\MobileMoney\mtn\Common\MoMoConstant;
//use App\Models\MobileMoney\mtn\Util\MoMoPaymentUtil;
//use http\Exception;
//
//class RequestPaymentService extends MoMoConstant
//{
//    public function requestPayment ( RequestPaymentRequest $paymentRequest ): RequestPaymentResponse
//    {
//        $paymentResponse = new RequestPaymentResponse;
//
//        if ( strcasecmp(self::MOBILEMONEY1_5, self::getVersion()) == 0 )
//        {
//            $requestPayment15Response = new _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse ();//_0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse
//            try
//            {
//                $requestPayment15Response = MoMoPaymentUtil::sendRequestPayment15 ( $paymentRequest );
//            }
//            catch ( Exception $e )
//            {
////                $e.printStackTrace ();
//            }
//            if ( !Common::checkNull ( $requestPayment15Response ) )
//            {
//                $this->populate15TransactionInfo ( $requestPayment15Response, $paymentResponse, $paymentRequest );
//                $this->setRequestPaymentResponse ( $paymentRequest, $paymentResponse );
//            }
//            else
//            {
//                $paymentResponse->StatusCode = self::REQUESTPAYMENT_FAILURE ;
//                $paymentResponse->StatusDesc = ErrorCodeConstants::ERRDESTION_100 ;
//            }
//        }
//        else if (strcmp(self::MOBILEMONEY1_7, self::getVersion() ) == 0 )
//        {
//            $requestPayment17Response = new _0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentResponse (); //_0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentResponse
//
//            try
//            {
//                $requestPayment17Response = MoMoPaymentUtil::sendRequestPayment17 ( $paymentRequest );
//            }
//            catch ( Exception $e )
//            {
////                e.printStackTrace ();
//            }
//
//            if ( !Common::checkNull ( $requestPayment17Response ) )
//            {
//                $this->populate17TransactionInfo ( $requestPayment17Response, $paymentResponse, $paymentRequest );
//                $this->setRequestPaymentResponse ( $paymentRequest, $paymentResponse );
//            }
//            else
//            {
//                $paymentResponse->StatusCode = self::REQUESTPAYMENT_FAILURE;
//                $paymentResponse->StatusDesc = ErrorCodeConstants::ERRDESTION_100;
//            }
//        }
//        return $paymentResponse;
//    }
//
//    private static function populate15TransactionInfo (ProcessRequestResponse $requestPayment15Response, RequestPaymentResponse $requestPaymentResponse,
//                                                       RequestPaymentRequest $requestPaymentReq )
//    {
//        $returnValues15 = []; //_0.ug_v1.mtn.mobilemoney.b2b.Parameter[]
//
//        $returnValues15 = $requestPayment15Response->get_return ();
//
//        if ( Common::checkNull ( $returnValues15 ) )
//        {
//            $requestPaymentResponse->StatusCode = self::REQUESTPAYMENT_FAILURE ;
//            $requestPaymentResponse->StatusDesc = ErrorCodeConstants::ERRDESTION_100 ;
//            return;
//        }
//
//        $returnValuesLength = sizeof($returnValues15);
//        for ( $i = 0; $i < $returnValuesLength; $i++ )
//        {
//            $paramName = $returnValues15[$i]->getName ()->getName_type0 ();
//            $paramValue = $returnValues15[$i]->getValue ()->getValue_type0 ();
//
//            self::setParamValues ( $paramName, $paramValue, $requestPaymentResponse );
//        }
//    }
//
//    /*_0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentResponse */
//    private static function populate17TransactionInfo ( $requestPayment17Response, RequestPaymentResponse $requestPaymentResponse,
//                                                        RequestPaymentRequest $requestPaymentReq )
//    {
//        $returnValues17 = []; //_0.zm_v1.mtn.mobilemoney.b2b.Parameter[]
//
//        $returnValues17 = $requestPayment17Response->get_return ();
//
//        if ( Common::checkNull ( $returnValues17 ) )
//        {
//            $requestPaymentResponse->StatusCode = ErrorCodeConstants::ERRCODE_100 ;
//            $requestPaymentResponse->StatusDesc = ErrorCodeConstants::ERRDESTION_100 ;
//
//            return;
//        }
//        $returnValuesLength = sizeof($returnValues17);
//
//        for ( $i = 0; $i < $returnValuesLength; $i++ )
//        {
//            $param17Name = $returnValues17[$i]->getName ()->getName_type0 ();
//            $param17Value = $returnValues17[$i]->getValue ()->getValue_type0 ();
//
//            self::setParamValues ( $param17Name, $param17Value, $requestPaymentResponse );
//        }
//    }
//
//    public static function setParamValues ( $paramName, $paramValue, RequestPaymentResponse $requestPaymentResponse )
//    {
//        if ( strcmp($paramName, self::SOAPBODY_STATUSCODE) == 0 )
//        {
//            $requestPaymentResponse->StatusCode = $paramValue;
//        }
//        else if ( strcmp($paramName, self::SOAPBODY_STATUSDESC) == 0 )
//        {
//            $requestPaymentResponse->StatusDesc = $paramValue;
//        }
//    }
//
//    private function setRequestPaymentResponse ( RequestPaymentRequest $request, RequestPaymentResponse $requestPaymentResponse )
//    {
//        $requestPaymentResponse->ProcessingNumber = $request->ProcessingNumber ;
//        $requestPaymentResponse->ThirdPartyAcctRef = null;
//        $requestPaymentResponse->SenderID = $request->SenderId ;
//    }
//}
