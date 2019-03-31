<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/24/2019
 * Time: 05:29
 */

namespace App\Models\MobileMoney\Mtn\Util;

use App\Models\MobileMoney\mtn\Common\MoMoConstant;
use Phpro\SoapClient\Xml\SoapXml;
use DOMDocument;
use DOMElement;

/*
 * Extension of Phpro SoapXml to add more functionality
 */
class RyztekSoapXml extends SoapXml
{
    /*
     * Soap Header
     */
    protected $soapHeader;

    /**
     * RyztekSoapXml constructor.
     *
     * @param DOMDocument $xml
     */
    public function __construct(DOMDocument $xml)
    {
        parent::__construct($xml);

        // Register some default namespaces for easy access:
        $this->registerNamespace('SOAP-ENV', $this->getSoapNamespaceUri());

        if ($bodyNamespace = $this->detectBodyContentsNamespace()) {
            $this->registerNamespace('application', $bodyNamespace);
        }
    }

    /**
     * @return DOMElement
     */
    public function createSoapHeader(): DOMElement
    {
        $this->soapHeader = $this->getXmlDocument()->createElement('SOAP-ENV:Header');
        $head = $this->getXmlDocument()->createElement('RequestSOAPHeader');
//        $spId = $this->getXmlDocument()->createElement('spId');
//        $head->appendChild($spId);
//        $head->appendChild(new \DOMAttr('xmlns', 'http://www.huawei.com.cn/schema/common/v2_1'));
        $head->setAttribute('xmlns', 'http://www.huawei.com.cn/schema/common/v2_1');
//        new \DOMAttr('xmlns', 'http://www.huawei.com.cn/schema/common/v2_1');
        $this->soapHeader->appendChild($head);
//        $this->soapHeader = new DOMElement('SOAP-ENV:Header');
//        $this->getEnvelope()->appendChild($this->soapHeader);
//        $this->getXmlDocument()->insertBefore($this->soapHeader, $this->getBody());
//        $this->soapHeader = $this->getXmlDocument()->createElementNS($this->getSoapNamespaceUri(), 'SOAP-ENV:Header');
        return $this->soapHeader;
    }

    /**
     * @param string $prefix
     * @param string $namespaceUri
     */
//    public function setHeaderNamespace(string $prefix, string $namespaceUri)
//    {
//        $this->soapHeader->setAttributeNS(self::XMLNS_XMLNS, sprintf('xmlns:%s', $prefix), $namespaceUri);
//        $this->registerNamespace($prefix, $namespaceUri);
//    }

    /**
     * @return mixed
     */
    public function getSoapHeader()
    {
        return $this->soapHeader;
    }

    /**
     * @return mixed
     */
    public function populateSoapHeader($spId, $spPassword, $serviceId, $bundleID, $timeStamp)
    {
        $spIdE = $this->getXmlDocument()->createElement(MoMoConstant::SOAPHEADER_SPID, $spId);
        $this->soapHeader->firstChild->appendChild($spIdE);
        $spPasswordE = $this->getXmlDocument()->createElement(MoMoConstant::SOAPHEADER_SPPASSWORD, $spPassword);
        $this->soapHeader->firstChild->appendChild($spPasswordE);
        $serviceIdE = $this->getXmlDocument()->createElement(MoMoConstant::SOAPHEADER_SERVICEID, $serviceId);
        $this->soapHeader->firstChild->appendChild($serviceIdE);
        $bundleIDE = $this->getXmlDocument()->createElement('bundleID', $bundleID);
        $this->soapHeader->firstChild->appendChild($bundleIDE);
        $timeStampE = $this->getXmlDocument()->createElement(MoMoConstant::SOAPHEADER_TIMESTAMP, $timeStamp);
        $this->soapHeader->firstChild->appendChild($timeStampE);
        return $this->soapHeader;
    }
}
