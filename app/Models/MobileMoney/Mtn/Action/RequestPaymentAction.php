<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:39
// */
//
//namespace App\Models\MobileMoney\mtn\Action;
//
//use App\Models\MobileMoney\mtn\Model\RequestPaymentRequest;
//use App\Models\MobileMoney\mtn\Model\RequestPaymentResponse;
//use App\Models\MobileMoney\mtn\Service\RequestPaymentCompleteService;
//use App\Models\MobileMoney\mtn\Service\RequestPaymentService;
//
//class RequestPaymentAction
//{
//    private $req; // RequestPaymentRequest
//    private $res; // RequestPaymentResponse
//
//    public function getReq (): RequestPaymentRequest
//    {
//        return $this->req;
//    }
//
//    public function getRes (): RequestPaymentResponse
//    {
//        return $this->res;
//    }
//
//    public function setRes ( RequestPaymentResponse $res )
//    {
//        $this->res = $res;
//    }
//
//    public function setReq ( RequestPaymentRequest $req )
//    {
//        $this->req = $req;
//    }
//
//    public function showPage ()
//    {
//        return "success";
//    }
//
//    public function requestPayment ()
//    {
//        $reqService = new RequestPaymentService (); //RequestPaymentService
//        $reqPaymentResponse = $reqService->requestPayment ( $this->req ); //RequestPaymentResponse
//        $this->setRes ( $reqPaymentResponse );
//        return "successRes";
//    }
//
//    public function queryResponsePayment()
//    {
//        $processingNumber = $this->req->ProcessingNumber;
//        $this->setRes ( new RequestPaymentResponse () );
//        RequestPaymentCompleteService::queryPaymentCompleteResponse ( $processingNumber, $this->res );
//        return "successRes";
//    }
//}
