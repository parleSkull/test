<?php

namespace App\Models\MobileMoney\Mtn\Util;

use App\Models\MobileMoney\Mtn\Util\Type;
use Phpro\SoapClient\Soap\ClassMap\ClassMapCollection;
use Phpro\SoapClient\Soap\ClassMap\ClassMap;

class RequestPaymentClassmap
{

    public static function getCollection() : \Phpro\SoapClient\Soap\ClassMap\ClassMapCollection
    {
        return new ClassMapCollection([
            new ClassMap('processRequest', Type\ProcessRequest::class),
            new ClassMap('parameter', Type\Parameter::class),
            new ClassMap('processRequestResponse', Type\ProcessRequestResponse::class),
        ]);
    }


}

