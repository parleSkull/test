<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:52
// */
//
//namespace App\Models\MobileMoney\mtn\Util;
//
////import java.rmi.RemoteException;
////
////import org.apache.axis2.transport.http.HTTPConstants;
//
////import _0.ug_v1.mtn.mobilemoney.b2b.Name_type1;
////import _0.ug_v1.mtn.mobilemoney.b2b.Parameter;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequest;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestE;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponseE;
////import _0.ug_v1.mtn.mobilemoney.b2b.UMMServiceServiceStub;
////import _0.ug_v1.mtn.mobilemoney.b2b.Value_type1;
//
//use App\Models\MobileMoney\mtn\Model\DepositMobileMoneyRequest;
//use App\Models\MobileMoney\mtn\Common\Common;
//use App\Models\MobileMoney\mtn\Common\MoMoConstant;
//
//abstract class MoMoDepositUtil extends MoMoConstant
//{
//    // returns _0.zm_v1.mtn.mobilemoney.b2b.Parameter
//    public static function setparameters17($name, $value)
//    {
//        $nameType17 = new _0.zm_v1.mtn.mobilemoney.b2b.Name_type1(); //_0.zm_v1.mtn.mobilemoney.b2b.Name_type1
//        $valueType17 = new _0.zm_v1.mtn.mobilemoney.b2b.Value_type1(); //_0.zm_v1.mtn.mobilemoney.b2b.Value_type1
//        $parameter17 = new _0.zm_v1.mtn.mobilemoney.b2b.Parameter(); //_0.zm_v1.mtn.mobilemoney.b2b.Parameter
//
//        $nameType17->setName_type0($name);
//        if (!Common::checkNullorEmpty($value))
//        {
//            $valueType17->setValue_type0($value);
//        }else
//        {
//            $valueType17->setValue_type0(MoMoConstant::EMPTY_STRING);
//        }
//        $parameter17->setName($nameType17);
//        $parameter17->setValue($valueType17);
//
//        return $parameter17;
//    }
//
//    //returns _0.ug_v1.mtn.mobilemoney.b2b.Parameter
//public static function setparameters15($name, $value)
//{
//
//$nameType15 = new Name_type1(); //Name_type1
//$valueType15 = new Value_type1(); //Value_type1
//$parameter15 = new Parameter(); //Parameter
//
//$nameType15->setName_type0($name);
//if (!Common::checkNullorEmpty($value))
//{
//$valueType15->setValue_type0($value);
//}
//        else
//        {
//            $valueType15->setValue_type0(MoMoConstant::EMPTY_STRING);
//        }
//        $parameter15->setName($nameType15);
//        $parameter15->setValue($valueType15);
//
//        return $parameter15;
//    }
//
////throws RemoteException
//    public static function sendDepositMoney15(DepositMobileMoneyRequest $depReq): ProcessRequestResponse
//    {
//        $depositMoMoUrl = self::getReqDepositUrl();
//
//        $momoStub = null; //UMMServiceServiceStub
//        $processReqE = null; //ProcessRequestE
//        $processResponseE = null; //ProcessRequestResponseE
//        $serviceId = $depReq->getServiceId();
//
//        try
//        {
//            $momoStub = new UMMServiceServiceStub(trim($depositMoMoUrl));
//
//            $timeOutInMilliSeconds = self::DEPOSITMOBILEMONEY_TIMEOUT;
//
//            $soapHeader =
//            new SoapHeaderUtil($depReq->SpId, $depReq->SpPassword,$depReq->ServiceId, $depReq->BundleId);
//
//            $soapHeader.setReqSoapHead($momoStub);
//
//            $momoStub->_getServiceClient()->getOptions()->setProperty(HTTPConstants::SO_TIMEOUT, $timeOutInMilliSeconds);
//
//            $momoStub->_getServiceClient()->getOptions()->setProperty(HTTPConstants::CONNECTION_TIMEOUT,
//                $timeOutInMilliSeconds);
//
//            $processReqE = new ProcessRequestE();
//            $processResponseE = new ProcessRequestResponseE();
//
//            self::setValuesInRequest15Obj($depReq, $processReqE, $serviceId);
//
//            $processResponseE = $momoStub->depositMobileMoney($processReqE);
//
//        }
//        catch (RemoteException $ex)
//        {
////            throw $ex;
//        }
//        catch (Exception $e)
//        {
////            e.printStackTrace ();
//        }
//        finally
//        {
//            // cleanUpStub(momoStub);
//        }
//
//        return $processResponseE->getProcessRequestResponse();
//    }
//
//    // returns _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestResponse
//    public static function sendDepositMobileMoney17(DepositMobileMoneyRequest $reqPayment)
//    {
//        $depositMoMoUrl = self::getReqDepositUrl();
//
//        $momoStub = null; //_0.zm_v1.mtn.mobilemoney.b2b.UMMServiceServiceStub
//
//        $processReqE = null; //_0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestE
//        $processResponseE = null; // _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestResponseE
//
//        $serviceId = $reqPaymentBean->getServiceId();
//        try
//        {
//            $momoStub = new _0.zm_v1.mtn.mobilemoney.b2b.UMMServiceServiceStub(trim($depositMoMoUrl));
//
//            $timeOutInMilliSeconds = self::DEPOSITMOBILEMONEY_TIMEOUT;
//
//            $momoStub->_getServiceClient()->getOptions()->setProperty(HTTPConstants::SO_TIMEOUT, $timeOutInMilliSeconds);
//
//            $momoStub->_getServiceClient()->getOptions()->setProperty(HTTPConstants::CONNECTION_TIMEOUT, $timeOutInMilliSeconds);
//
//            $soapHeader =
//            new SoapHeaderUtil($reqPayment->SpId,$reqPayment->SpPassword, $reqPayment->ServiceId,$reqPayment->BundleId);
//
//            $soapHeader->setReqSoapHead($momoStub);
//
//            $processReqE = new _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestE();
//            $processResponseE = new _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestResponseE();
//
//            self::setValuesInRequest17Obj($reqPayment, $processReqE, $serviceId);
//
//            $processResponseE = $momoStub->depositMobileMoney($processReqE);
//
//        }
//        catch (RemoteException $ex)
//        {
////            ex.printStackTrace ();
//        }
//        finally
//        {
//            // cleanUpStub(momoStub);
//        }
//
//        return $processResponseE->getProcessRequestResponse();
//    }
//
//    private static function setValuesInRequest15Obj(DepositMobileMoneyRequest $depReq,
//        ProcessRequestE $processReqE, $seeServiceId)
//    {
//        $processReq15 = new ProcessRequest();
//
//        $paramList15 = new Parameter[MoMoConstant::FOURTEEN]; //Parameter[]
//
//        //processing Number
//        $paramList15[MoMoConstant::ZERO] =
//            self::setparameters15(MoMoConstant::SOAPBODY_PROCESSINGNUMBER, $depReq->ProcessingNumber);
//
//        //ServiceID
//        $paramList15[MoMoConstant::ONE] = self::setparameters15(MoMoConstant::SOAPBODY_SERVICEID, $depReq->ServiceId);
//
//        //SenderID
//        $paramList15[MoMoConstant::TWO] = self::setparameters15(MoMoConstant::SOAPBODY_SENDERID, $depReq->SenderId);
//
//        //OpCoID
//        $paramList15[MoMoConstant::THREE] = self::setparameters15(MoMoConstant::SOAPBODY_OPCOID, $depReq->OpCoID );
//
//        //MSISDNNum
//        $paramList15[MoMoConstant::FOUR] = self::setparameters15(MoMoConstant::SOAPBODY_MSISDNNUM, $depReq->Msisdn );
//
//        //Narration
//        $paramList15[MoMoConstant::FIVE] = self::setparameters15(MoMoConstant::SOAPBODY_NARRATION, $depReq->Narration);
//
//        //PrefLang
//        $paramList15[MoMoConstant::SIX] = self::setparameters15(MoMoConstant::SOAPBODY_PREFLANG, $depReq->PrefLang);
//
//        //IMSINum
//        $paramList15[MoMoConstant::SEVEN] = self::setparameters15(MoMoConstant::SOAPBODY_IMSINUM, $depReq->ImsiNum );
//
//        //OrderDateTime
//        $paramList15[MoMoConstant::EIGHT] = self::setparameters15(MoMoConstant::SOAPBODY_ORDERDATETIME, $depReq->OrderDateTime);
//
//        //Amount
//        $paramList15[MoMoConstant::NINE] = self::setparameters15(MoMoConstant::SOAPBODY_AMOUNT, $depReq->Amount);
//
//        $processReq15->setParameter($paramList15);
//
//        $processReq15->setServiceId($depReq->ServiceId);
//
//        $processReq15->setProcessRequest($processReq15);
//    }
//
//    private static function setValuesInRequest17Obj(DepositMobileMoneyRequest $depReq,
//        _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequestE $processReqE, $seeServiceId)
//    {
//        $processReq17 = new _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequest(); //_0.zm_v1.mtn.mobilemoney.b2b.ProcessRequest
//        $paramList17 =
//        new _0.zm_v1.mtn.mobilemoney.b2b.Parameter[MoMoConstant::THIRTEEN]; // _0.zm_v1.mtn.mobilemoney.b2b.Parameter[]
//
//        $momoServiceId = $depReq->ServiceId;
//        $momSenderID = $depReq->SenderId;
//
//        //processing Number
//        $paramList17[MoMoConstant::ZERO] =
//            self::setparameters17(MoMoConstant::SOAPBODY_PROCESSINGNUMBER, $depReq->ProcessingNumber);
//
//        //ServiceID
//        $paramList17[MoMoConstant::ONE] = setparameters17(MoMoConstant::SOAPBODY_SERVICEID, $momoServiceId);
//
//        //SenderID
//        $paramList17[MoMoConstant::TWO] = setparameters17(MoMoConstant::SOAPBODY_SENDERID, $momSenderID);
//
//        //OpCoID
//        $paramList17[MoMoConstant::THREE] =
//            setparameters17(MoMoConstant::SOAPBODY_OPCOID, $depReq->OpCoID );
//
//        //MSISDNNum
//        $paramList17[MoMoConstant::FOUR] = setparameters17(MoMoConstant::SOAPBODY_MSISDNNUM, $depReq->Msisdn);
//
//        //Narration
//        $paramList17[MoMoConstant::FIVE] =
//            setparameters17(MoMoConstant::SOAPBODY_NARRATION, $depReq->Narration);
//
//        //PrefLang
//        $paramList17[MoMoConstant::SIX] = setparameters17(MoMoConstant::SOAPBODY_PREFLANG, $depReq->PrefLang);
//
//        //IMSINum
//        $paramList17[MoMoConstant::SEVEN] = setparameters17(MoMoConstant::SOAPBODY_IMSINUM, $depReq->ImsiNum );
//
//        //OrderDateTime
//        $paramList17[MoMoConstant::EIGHT] =
//            setparameters17(MoMoConstant::SOAPBODY_ORDERDATETIME, $depReq->OrderDateTime);
//
//        //Amount
//        $paramList17[MoMoConstant::NINE] =
//            setparameters17(MoMoConstant::SOAPBODY_AMOUNT, $depReq->Amount);
//
//        $processReq17->setParameter($paramList17);
//
//        $serviceId = $depReq->ServiceId ;
//        $processReq17->setServiceId($serviceId);
//
//        $processReqE->setProcessRequest($processReq17);
//    }
//
//}
