<?php

namespace App\Models\MobileMoney\Mtn\Util;

use Phpro\SoapClient\Type\RequestInterface;
use App\Models\MobileMoney\Mtn\Util\Type;
use Phpro\SoapClient\Type\ResultInterface;
use Phpro\SoapClient\Exception\SoapException;

class DepositMobileMoneyClient extends \Phpro\SoapClient\Client
{

    /**
     * @param RequestInterface|Type\ProcessRequest $parameters
     * @return ResultInterface|Type\ProcessRequestResponse
     * @throws SoapException
     */
    public function depositMobileMoney(\App\Models\MobileMoney\Mtn\Util\Type\ProcessRequest $parameters) : \App\Models\MobileMoney\Mtn\Util\Type\ProcessRequestResponse
    {
        return $this->call('DepositMobileMoney', $parameters);
    }


}

