<?php

namespace App\Models\MobileMoney\Mtn\Util;

use App\Models\MobileMoney\Mtn\Util\Type\ProcessRequest;
use App\Models\MobileMoney\Mtn\Util\Type\ProcessRequestResponse;
use Phpro\SoapClient\Type\RequestInterface;
use App\Models\MobileMoney\Mtn\Util\Type;
use Phpro\SoapClient\Type\ResultInterface;
use Phpro\SoapClient\Exception\SoapException;
use Phpro\SoapClient\Client;

class RequestPaymentClient extends Client
{
    /**
     * @param RequestInterface|Type\ProcessRequest $parameters
     * @return ResultInterface|Type\ProcessRequestResponse
     * @throws SoapException
     */
    public function requestPayment(ProcessRequest $parameters) : ProcessRequestResponse
    {
        return $this->call('RequestPayment', $parameters);
    }
}
