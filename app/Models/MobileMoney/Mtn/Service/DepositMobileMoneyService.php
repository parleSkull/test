<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:49
// */
//
//namespace App\Models\MobileMoney\mtn\Service;
//
////import java.rmi.RemoteException;
//
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse;
//
//use App\Models\MobileMoney\mtn\Model\DepositMobileMoneyRequest;
//use App\Models\MobileMoney\mtn\Model\DepositMobileMoneyResponse;
//use App\Models\MobileMoney\mtn\Common\Common;
//use App\Models\MobileMoney\mtn\Common\ErrorCodeConstants;
//use App\Models\MobileMoney\mtn\Common\MoMoConstant;
//use App\Models\MobileMoney\mtn\Util\MoMoDepositUtil;
//use http\Exception;
//
//class DepositMobileMoneyService extends MoMoConstant
//{
//    public function depositMobileMoney ( DepositMobileMoneyRequest $depositReq ): DepositMobileMoneyResponse
//    {
//        $depositRes = new DepositMobileMoneyResponse();
//
//        $momoVersion = config("ryztek-mobilemoney.mtn.VERSION");
//
//
//        if ( strcasecmp(MoMoConstant::MOBILEMONEY1_5, $momoVersion) == 0 )
//        {
//            $depositMoney15Response = new _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse ();
//            try
//            {
//                $depositMoney15Response = MoMoDepositUtil::sendDepositMoney15 ( $depositReq );
//            }
//            catch ( Exception $ex )
//            {
//                if ( strcasecmp($ex->getMessage(), "Read timed out") == 0)
//                {
//                    $depositRes->StatusCode = MoMoConstant::TIMEOUT_RESULTCODE;
//                }
//                else
//                {
//                    $depositRes->StatusCode = ErrorCodeConstants::ERRCODE_100;
//                }
//            }
//
//            if ( !Common::checkNull ( $depositMoney15Response ) )
//            {
//                if ( !Common::checkNull ( $depositMoney15Response->get_return () ) )
//                {
//                    $this->populate15TransactionInfo ( $depositMoney15Response, $depositReq );
//                    $this->setDepositMoneyResponse ( $depositReq, $depositRes );
//                }
//            }
//        }
//        else if ( (strcasecmp( MoMoConstant::MOBILEMONEY1_7, $momoVersion) == 0))
//        {
//            $depositMoney17Response = new _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestResponse ();
//            try
//            {
//                $depositMoney17Response = MoMoDepositUtil::sendDepositMobileMoney17 ( $depositReq );
//            }
//            catch ( Exception $ex )
//            {
//                if ( strcasecmp($ex->getMessage(), "Read timed out") == 0)
//                {
//                    $depositRes->StatusCode = MoMoConstant::TIMEOUT_RESULTCODE;
//                    $depositRes->StatusDesc = "TIME OUT";
//                }
//                else
//                {
//                    $depositRes->StatusCode = ErrorCodeConstants::ERRCODE_100 ;
//                    $depositRes->StatusCode = "General failure" ;
//                }
//            }
//            if ( !Common::checkNull ( $depositMoney17Response ) )
//            {
//                $this->populate17TransactionInfo ( $depositMoney17Response, $depositReq );
//                $this->setDepositMoneyResponse ( $depositReq, $depositRes );
//            }
//        }
//        else
//        {
//            return $depositRes;
//        }
//
//        return $depositRes;
//    }
//
//    private function setDepositMoneyResponse ( DepositMobileMoneyRequest $depReq, DepositMobileMoneyResponse $depRes )
//    {
//        $depRes->ProcessingNumber = $depReq->ProcessingNumber;
//        $depRes->ThirdPartyAcctRef = null;
//        $depRes->SenderID = $depReq->SenderId;
//        $depRes->StatusCode = $depReq->StatusCode;
//        $depRes->StatusDesc = $depReq->StatusDesc;
//    }
//
//    private function populate15TransactionInfo ( ProcessRequestResponse $depositMoney15Response, DepositMobileMoneyRequest $depReq )
//    {
//        $returnValues15 = $depositMoney15Response.get_return (); // _0.ug_v1.mtn.mobilemoney.b2b.Parameter[]
//
//        if ( $this->isReturnValuesNull ( $returnValues15, $depReq ) )
//        {
//            return;
//        }
//        $returnValuesLength = sizeof($returnValues15);
//        for ( $i = 0; $i < $returnValuesLength; $i++ )
//        {
//            $paramName = $returnValues15[$i]->getName ()->getName_type0 ();
//            $paramValue = $returnValues15[$i]->getValue ()->getValue_type0 ();
//
//            $this->setParamValues ( $paramName, $paramValue, $depReq );
//        }
//    }
//
//    private function populate17TransactionInfo (ProcessRequestResponse $depositMoney17Response, DepositMobileMoneyRequest $depReq )
//    {
//        $returnValues17 = $depositMoney17Response->get_return (); //_0.zm_v1.mtn.mobilemoney.b2b.Parameter[]
//
//        if ( $this->isReturnValuesNull ( $returnValues17, $depReq ) )
//        {
//            return;
//        }
//        $returnValuesLength = sizeof($returnValues17);
//        for ( $i = 0; $i < $returnValuesLength; $i++ )
//        {
//            $param17Name = $returnValues17[$i]->getName ()->getName_type0 ();
//            $param17Value = $returnValues17[$i]->getValue ()->getValue_type0 ();
//
//            $this->setParamValues ( $param17Name, $param17Value, $depReq );
//        }
//    }
//
//    public static function setParamValues ( $paramName, $paramValue, DepositMobileMoneyRequest $depositMoneyResponse )
//    {
//        if ( strcmp($paramName, MoMoConstant::SOAPBODY_STATUSCODE) == 0 )
//        {
//            $depositMoneyResponse->StatusCode = $paramValue;
//        }
//        else if ( strcmp($paramName, MoMoConstant::SOAPBODY_STATUSDESC) == 0 )
//        {
//            $depositMoneyResponse->StatusDesc = $paramValue;
//        }
//    }
//
//    public static function isReturnValuesNull ( $returnValues, DepositMobileMoneyRequest $momoDeposit ): bool
//    {
//        $isNull = false;
//        if ( Common::checkNull ( $returnValues ) )
//        {
//            $momoDeposit->StatusCode = MoMoConstant::ADDITIONAL_DATA_ERROR;
//            $isNull = true;
//        }
//
//        return $isNull;
//    }
//}
