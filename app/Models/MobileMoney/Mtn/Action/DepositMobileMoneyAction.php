<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:38
// */
//
//namespace App\Models\MobileMoney\mtn\Action;
//
//use App\Models\MobileMoney\mtn\Model\DepositMobileMoneyRequest;
//use App\Models\MobileMoney\mtn\Model\DepositMobileMoneyResponse;
//use App\Models\MobileMoney\mtn\Service\DepositMobileMoneyService;
//use http\Exception;
//
//class DepositMobileMoneyAction
//{
//    private $req; //DepositMobileMoneyRequest
//    private $res; //DepositMobileMoneyResponse
//
//    public function showPage ()
//    {
//        return "success";
//    }
//
//    public function getReq (): DepositMobileMoneyRequest
//    {
//        return $this->req;
//    }
//
//    public function setReq ( DepositMobileMoneyRequest $req )
//    {
//        $this->req = $req;
//    }
//
//    public function getRes (): DepositMobileMoneyResponse
//    {
//        return $this->res;
//    }
//
//    public function setRes ( DepositMobileMoneyResponse $res )
//    {
//        $this->res = $res;
//    }
//
//    public function depositMobileMoney ()
//    {
//        $depReqService = null; //DepositMobileMoneyService
//        $depRes = null; // DepositMobileMoneyResponse
//
//        $this->setRes( new DepositMobileMoneyResponse () );
//        try
//        {
//            $depReqService = new DepositMobileMoneyService ();
//            $depRes = $depReqService->depositMobileMoney ( $this->req );
//
//            $this->getRes ()->ProcessingNumber = $depRes->ProcessingNumber;
//            $this->getRes ()->StatusCode = $depRes->StatusCode ;
//            $this->getRes ()->StatusDesc = $depRes->StatusDesc;
//        }
//        catch ( Exception $e )
//        {
////            e.printStackTrace ();
//        }
//
//        return "successRes";
//    }
//}
