<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/24/2019
 * Time: 00:34
 */

namespace App\Models\MobileMoney\Mtn\Util;

use App\Models\MobileMoney\Mtn\Util\Type\RequestSoapHeader;
use GuzzleHttp\Promise\PromiseInterface;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Phpro\SoapClient\Middleware\MiddleWare;
use Psr\Http\Message\ResponseInterface;

class RequestSoapHeaderMiddleware extends MiddleWare
{
    /**
     * @var string
     */
    private $spId;

    /**
     * @var string
     */
    private $spPassword;

    /**
     * @var string
     */
    private $serviceId;

    /**
     * @var string
     */
    private $bundleID;

    /**
     * @var string
     */
    protected $timeStamp;


    public function __construct(RequestSoapHeader $header)
    {
        $this->spId = $header->getSpId();
        $this->spPassword = $header->getSpPassword();
        $this->serviceId = $header->getServiceId();
        $this->bundleID = $header->getBundleID();
        $this->timeStamp = $header->getTimeStamp();
    }

    public function getName(): string
    {
        return 'soap_header_middleware';
    }

    /**
     * @param callable         $handler
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return Promise|PromiseInterface
     */
    public function beforeRequest(callable $handler, RequestInterface $request): Promise
    {
        // Load the XML from a PSR7 request or response:
        $xml = RyztekSoapXml::fromStream($request->getBody());
        $newHeader = $xml->createSoapHeader();
//        $newHeader = $xml->addSoapHeaderChild('http://www.huawei.com.cn/schema/common/v2_1', 'RequestSOAPHeader');
//        $xml->setHeaderNamespace('tns', "http://www.huawei.com.cn/schema/common/v2_1");
        $xml->prependSoapHeader($newHeader);
        $xml->populateSoapHeader($this->spId, $this->spPassword, $this->serviceId, $this->bundleID, $this->timeStamp);

        // Use the manipulated XML in your PSR7 request or response:
        $request = $request->withBody($xml->toStream());
        return $handler($request);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function afterResponse(ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}