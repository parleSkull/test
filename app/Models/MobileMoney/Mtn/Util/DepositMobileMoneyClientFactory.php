<?php

namespace App\Models\MobileMoney\Mtn\Util;

use App\Models\MobileMoney\Mtn\Util\DepositMobileMoneyClient;
use App\Models\MobileMoney\Mtn\Util\DepositMobileMoneyClassmap;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Phpro\SoapClient\Soap\Driver\ExtSoap\ExtSoapEngineFactory;
use Phpro\SoapClient\Soap\Driver\ExtSoap\ExtSoapOptions;

class DepositMobileMoneyClientFactory
{

    public static function factory(string $wsdl) : \App\Models\MobileMoney\Mtn\Util\DepositMobileMoneyClient
    {
        $engine = ExtSoapEngineFactory::fromOptions(
            ExtSoapOptions::defaults($wsdl, [])
                ->withClassMap(DepositMobileMoneyClassmap::getCollection())
        );
        $eventDispatcher = new EventDispatcher();

        return new DepositMobileMoneyClient($engine, $eventDispatcher);
    }


}

