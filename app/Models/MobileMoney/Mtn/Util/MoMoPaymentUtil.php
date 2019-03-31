<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:54
// */
//
//namespace App\Models\MobileMoney\mtn\Util;
//
////import java.rmi.RemoteException;
//
////import _0.ug_v1.mtn.mobilemoney.b2b.Parameter;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequest;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestE;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponse;
////import _0.ug_v1.mtn.mobilemoney.b2b.ProcessRequestResponseE;
////import _0.ug_v1.mtn.mobilemoney.b2b.UMMServiceServiceStub;
//
//use App\Models\MobileMoney\mtn\Model\RequestPaymentRequest;
//use App\Models\MobileMoney\mtn\Common\Common;
//use App\Models\MobileMoney\mtn\Common\MoMoConstant;
//
//class MoMoPaymentUtil extends MoMoConstant
//{
//    public static function sendRequestPayment15 ( RequestPaymentRequest $request ): ProcessRequestResponse
//    {
//
//        $momoStub = null; //UMMServiceServiceStub
//        $processReqE = null; //ProcessRequestE
//        $processResponseE = null; //ProcessRequestResponseE
//
//        try
//        {
//
//            $momoStub = new UMMServiceServiceStub ( trim (self::getReqPaymentUrl()) );
//
//            $soapHeader = new SoapHeaderUtil ( $request->SpId,
//                $request->SpPswd , $request->ServiceId ,$request->BundleID );
//
//            $soapHeader->setRequestPaymentReqSoapHead ( $momoStub );
//
//            $processReqE = new ProcessRequestE ();
//            $processReponseE = new ProcessRequestResponseE ();
//
//            setValuesInRequest15Obj ( $request, $processReqE );
//
//            $processResponseE = $momoStub->requestPayment ( $processReqE );
//
//        }
//        catch ( Exception $ex )
//        {
////            ex.printStackTrace ();
//        }
//        finally
//        {
//            // MoMoUtil.cleanUpStub(momoStub);
//        }
//
//        return $processResponseE->getProcessRequestResponse ();
//    }
//
//    // returns _0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentResponse
//    public static function sendRequestPayment17 ( RequestPaymentRequest $reqPayment )
//    {
//        $momoStub = null; //_0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentStub
//        $processReqE = null; //_0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentRequestE
//        $processResponseE = null; //_0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentResponseE
//
//        try
//        {
//            $momoStub = new _0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentStub ( trim (self::getReqPaymentUrl()) );
//
//            $soapHeader = new SoapHeaderUtil ( $reqPayment->SpId , $reqPayment->SpPswd , $reqPayment->ServiceId  ,$reqPayment->BundleID );
//
//            $soapHeader->setRequestPaymentReqSoapHead ( $momoStub );
//
//            $processReqE = new _0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentRequestE ();
//            $processResponseE = new _0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentResponseE ();
//
//            setValuesInRequest17Obj ( $reqPayment, $processReqE );
//
//            $processResponseE = $momoStub->requestPayment ( $processReqE );
//
//        }
//        catch ( RemoteException $ex )
//        {
////            ex.printStackTrace ();
//        }
//        finally
//        {
//            // MoMoUtil.cleanUpStub(momoStub);
//        }
//
//        return $processResponseE->getProcessRequestResponse ();
//    }
//
//    private static function setValuesInRequest15Obj ( RequestPaymentRequest $reqPayment,
//                                                      ProcessRequestE $processReqE )
//    {
//        $processReq15 = new ProcessRequest ();
//        $paramList15 = new Parameter [MoMoConstant::TWELVE]; //Parameter []
//
//        // processing Number
//        $paramList15[MoMoConstant::ZERO] = MoMoDepositUtil::setparameters15 (
//            MoMoConstant::SOAPBODY_PROCESSINGNUMBER, $reqPayment->ProcessingNumber  );
//
//        // ServiceID
//        $paramList15[MoMoConstant::ONE] = MoMoDepositUtil::setparameters15 ( MoMoConstant::SOAPBODY_SERVICEID,
//            $reqPayment->ServiceId  );
//
//        // DueAmount
//        $paramList15[MoMoConstant::TWO] = MoMoDepositUtil::setparameters15 (
//            MoMoConstant::SOAPBODY_DUEAMOUNT, $reqPayment->DueAmount  ) );
//
//        // OpCoID
//        $paramList15[MoMoConstant::THREE] = MoMoDepositUtil::setparameters15 ( MoMoConstant::SOAPBODY_OPCOID,
//            $reqPayment->OpCoId  );
//
//        // MSISDNNum
//        $paramList15[MoMoConstant::FOUR] = MoMoDepositUtil::setparameters15 (
//            MoMoConstant::SOAPBODY_MSISDNNUM, $reqPayment->MSISDNNum  );
//
//        // AcctRef
//        $paramList15[MoMoConstant::FIVE] = MoMoDepositUtil::setparameters15 ( MoMoConstant::SOAPBODY_ACCTREF,
//            $reqPayment->AcctRef  );
//
//        // AcctBalance
//        $paramList15[MoMoConstant::SIX] = MoMoDepositUtil::setparameters15 (
//            MoMoConstant::SOAPBODY_ACCTBALANCE, $reqPayment->AcctBalance  );
//
//        // MinDueAmount
//        $paramList15[MoMoConstant::SEVEN] = MoMoDepositUtil::setparameters15 (
//            MoMoConstant::SOAPBODY_MINDUEAMOUNT, $reqPayment->MinDueAmount  );
//
//        // PrefLang
//        $paramList15[MoMoConstant::EIGHT] = MoMoDepositUtil::setparameters15 (
//            MoMoConstant::SOAPBODY_PREFLANG, $reqPayment->PrefLang  );
//
//        if ( !Common::checkNull ( $reqPayment->Narration  ) )
//        {
//            // Narration (Reason)
//            $paramList15[MoMoConstant::NINE] = MoMoDepositUtil::setparameters15 (
//                MoMoConstant::SOAPBODY_NARRATION, $reqPayment->Narration  );
//        }
//        $processReq15->setParameter ( $paramList15 );
//
//        $processReq15->setServiceId ( $reqPayment->ServiceId  ) );
//
//        $processReqE->setProcessRequest ( $processReq15 );
//
//    }
//
//    private static function setValuesInRequest17Obj ( RequestPaymentRequest $reqPayment,
//                                                      _0.zm_v1.mtn.mobilemoney.b2b.RequestPaymentRequestE $processReqE )
//    {
//        $processReq17 = new _0.zm_v1.mtn.mobilemoney.b2b.ProcessRequest ();
//        $paramList17 = new _0.zm_v1.mtn.mobilemoney.b2b.Parameter [MoMoConstant::TWELVE]; //_0.zm_v1.mtn.mobilemoney.b2b.Parameter[]
//
//        // processing Number
//        $paramList17[MoMoConstant::ZERO] = MoMoDepositUtil::setparameters17 (
//                MoMoConstant::SOAPBODY_PROCESSINGNUMBER, $reqPayment->ProcessingNumber  );
//
//        // ServiceID
//        $paramList17[MoMoConstant::ONE] = MoMoDepositUtil::setparameters17 ( MoMoConstant::SOAPBODY_SERVICEID,
//                $reqPayment->ServiceId  );
//
//        // DueAmount
//        $paramList17[MoMoConstant::TWO] = MoMoDepositUtil::setparameters17 (
//                MoMoConstant::SOAPBODY_DUEAMOUNT, $reqPayment->DueAmount  ) );
//
//        // OpCoID
//        $paramList17[MoMoConstant::THREE] = MoMoDepositUtil::setparameters17 ( MoMoConstant::SOAPBODY_OPCOID,
//                $reqPayment->OpCoId  );
//
//        // MSISDNNum
//        $paramList17[MoMoConstant::FOUR] = MoMoDepositUtil::setparameters17 (
//                MoMoConstant::SOAPBODY_MSISDNNUM, $reqPayment->MSISDNNum  );
//
//        // AcctRef
//        $paramList17[MoMoConstant::FIVE] = MoMoDepositUtil::setparameters17 ( MoMoConstant::SOAPBODY_ACCTREF,
//                $reqPayment->AcctRef  );
//
//        // AcctBalance
//        $paramList17[MoMoConstant::SIX] = MoMoDepositUtil::setparameters17 (
//                MoMoConstant::SOAPBODY_ACCTBALANCE, $reqPayment->AcctBalance  );
//
//        // MinDueAmount
//        $paramList17[MoMoConstant::SEVEN] = MoMoDepositUtil::setparameters17 (
//                MoMoConstant::SOAPBODY_MINDUEAMOUNT, $reqPayment->MinDueAmount  );
//
//        // PrefLang
//        $paramList17[MoMoConstant::EIGHT] = MoMoDepositUtil::setparameters17 (
//                MoMoConstant::SOAPBODY_PREFLANG, $reqPayment->PrefLang  );
//
//        if ( !Common::checkNull ( $reqPayment->Narration  ) )
//        {
//            // Narration (Reason)
//            $paramList17[MoMoConstant::NINE] = MoMoDepositUtil::setparameters17 (
//                    MoMoConstant::SOAPBODY_NARRATION, $reqPayment->Narration  );
//        }
//
//$processReq17->setParameter ( $paramList17 );
//
//$processReq17->setServiceId ( $reqPayment->ServiceId  );
//
//$processReqE->setProcessRequest ( $processReq17 );
//
//}
//
//}
