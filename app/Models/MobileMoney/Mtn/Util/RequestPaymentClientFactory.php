<?php

namespace App\Models\MobileMoney\Mtn\Util;

use App\Models\MobileMoney\Mtn\Util\Type\RequestSoapHeader;
use Phpro\SoapClient\Soap\Handler\HttPlugHandle;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Phpro\SoapClient\Soap\Driver\ExtSoap\ExtSoapEngineFactory;
use Phpro\SoapClient\Soap\Driver\ExtSoap\ExtSoapOptions;
use Http\Adapter\Guzzle6\Client;

class RequestPaymentClientFactory
{

    public static function factory(string $wsdl) : RequestPaymentClient
    {
        $engine = ExtSoapEngineFactory::fromOptions(
            ExtSoapOptions::defaults($wsdl, [])
                ->withClassMap(RequestPaymentClassmap::getCollection())
        );
        $eventDispatcher = new EventDispatcher();

        return new RequestPaymentClient($engine, $eventDispatcher);
    }

    public static function factoryWithMiddleware(string $wsdl, RequestSoapHeader $header) : RequestPaymentClient
    {
        $handler = HttPlugHandle::createForClient(
            Client::createWithConfig(['headers' => ['User-Agent' => 'PHP-SOAP/7.2.0-1+ubuntu16.04.1+deb.sury.org+1']])
        );
        $handler->addMiddleware(new RequestSoapHeaderMiddleware($header));

        $engine = ExtSoapEngineFactory::fromOptionsWithHandler(
            ExtSoapOptions::defaults($wsdl, [])->withClassMap(RequestPaymentClassmap::getCollection()),
            $handler
        );

        $eventDispatcher = new EventDispatcher();

        return new RequestPaymentClient($engine, $eventDispatcher);
    }
}

