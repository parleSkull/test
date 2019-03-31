<?php
///**
// * Created by PhpStorm.
// * User: Steve
// * Date: 3/20/2019
// * Time: 19:55
// */
//
//namespace App\Models\MobileMoney\mtn\Util;
//
////import org.apache.axiom.om.OMAbstractFactory;
////import org.apache.axiom.om.OMFactory;
////import org.apache.axiom.om.OMNamespace;
////import org.apache.axiom.soap.SOAPFactory;
////import org.apache.axiom.soap.SOAPHeaderBlock;
////import org.apache.axis2.client.ServiceClient;
////import org.apache.axis2.client.Stub;
//
////import com.huawei.sdp.comm.util.DateFormatUtil;
////import com.huawei.sdp.see.axis2.soapheader.SDPSOAPHeader;
//
//use App\Models\MobileMoney\mtn\Common\Common;
//
//class SoapHeaderUtil
//{
//    private $spId;
//    private $spPswd;
//    private $serviceId;
//    private $bundleID;
//
//    public function __construct($spId, $spPswd, $serviceId, $bundleID )
//    {
//        $this->spId = $spId;
//        $this->spPswd = $spPswd;
//        $this->serviceId = $serviceId;
//        $this->bundleID = $bundleID;
//    }
//
//    // Stub $stub
//    public function setRequestPaymentReqSoapHead($stub)
//    {
//        $fac = OMAbstractFactory->getOMFactory(); //OMFactory
//$sfac = OMAbstractFactory->getSOAP11Factory(); //SOAPFactory
//$timeStampTemp = DateFormatUtil.getTimeStamp();
//
//    // namespace
//$omNs = $fac->createOMNamespace("http://www.huawei.com.cn/schema/common/v2_1", "tns"); //OMNamespace
//
//    // request
//$soapHeadB = $sfac->createSOAPHeaderBlock("RequestSOAPHeader", $omNs); //SOAPHeaderBlock
//
//    //spid
//$spID = sfac.createSOAPHeaderBlock(SDPSOAPHeader.SPID, $omNs); //SOAPHeaderBlock
//$spID->addChild($sfac->createOMText($this->spId));
//
//    //spPassword
//$spPassword = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.SPPASSWORD, $omNs); //SOAPHeaderBlock
//$spPassword->addChild($sfac->createOMText($this->spPswd));
//
//    // timeStamp
//$timeStamp = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.TIMESTAMP, $omNs); //SOAPHeaderBlock
//$timeStamp->addChild($sfac->createOMText($timeStampTemp));
//
//$soapHeadB->addChild($spID);
//$soapHeadB->addChild($spPassword);
//
//    // bundleId
//if (!Common::checkNullorEmpty($this->bundleID))
//{
//    $bundleId = $sfac->createSOAPHeaderBlock("bundleID", $omNs); //SOAPHeaderBlock
//    $bundleId->addChild($sfac->createOMText($bundleID));
//    $soapHeadB->addChild($bundleId);
//}
//
//// serviceId
//if (!Common::checkNullorEmpty($this->serviceId))
//{
//    $serviceID = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.SERVICEID, $omNs); //SOAPHeaderBlock
//    $serviceID->addChild($sfac->createOMText($serviceId));
//    $soapHeadB->addChild($serviceID);
//}
//
//$soapHeadB->addChild($timeStamp);
//
// $client = stub->_getServiceClient(); //ServiceClient
//
//        $client->addHeader($soapHeadB);
//
//    }
//
//    // Stub $stub
//    public function setReqSoapHead($stub)
//    {
//        $fac = OMAbstractFactory->getOMFactory(); //OMFactory
//$sfac = OMAbstractFactory->getSOAP11Factory(); //SOAPFactory
//$timeStampTemp = DateFormatUtil->getTimeStamp();
//
//    // namespace
//$omNs = $fac->createOMNamespace("http://www.huawei.com.cn/schema/common/v2_1", "tns"); //OMNamespace
//
//    // request
//$soapHeadB = $sfac->createSOAPHeaderBlock("RequestSOAPHeader", $omNs); //SOAPHeaderBlock
//
//    //SpId
//$spID = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.SPID, $omNs); //SOAPHeaderBlock
//$spID->addChild($sfac->createOMText($spId));
//$soapHeadB->addChild($spID);
//
//    //SP Password
//$spPassword = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.SPPASSWORD, $omNs); //SOAPHeaderBlock
//$spPassword->addChild($sfac->createOMText($spPswd));
//$soapHeadB->addChild($spPassword);
//
//    // bundleId
//if (!Common::checkNullorEmpty($bundleID))
//{
//    $bundleId = $sfac->createSOAPHeaderBlock("bundleID", $omNs); //SOAPHeaderBlock
//    $bundleId->addChild(sfac->createOMText($bundleID));
//$soapHeadB->addChild($bundleId);
//}
//
//// serviceId
//if (!Common::checkNullorEmpty($serviceId))
//{
//    $serviceID = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.SERVICEID, $omNs); //SOAPHeaderBlock
//    $serviceID->addChild($sfac->createOMText($serviceId));
//    $soapHeadB->addChild($serviceID);
//}
//
//// timeStamp
//$timeStamp = $sfac->createSOAPHeaderBlock(SDPSOAPHeader.TIMESTAMP, $omNs); //SOAPHeaderBlock
//        $timeStamp->addChild($sfac->createOMText($timeStampTemp));
//        $soapHeadB->addChild($timeStamp);
//
//        $client = $stub->_getServiceClient(); //ServiceClient
//        $client->addHeader($soapHeadB);
//
//    }
//}
