<?php

namespace App\Services\MobileMoney\Mpesa\C2B;

use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use App\Services\MobileMoney\Mpesa\Engine\Core;
use App\Services\MobileMoney\Mpesa\Repositories\ConfigurationRepository;
use App\Services\MobileMoney\Mpesa\Traits\MakesRequest;

/**
 * Class Identity.
 */
class Identity
{
    use MakesRequest;

    /**
     * Prepare the number validation request
     *
     * @param int $number
     * @param string $callback
     *
     * @param null $account
     * @return mixed
     * @throws \Exception
     */
    public function validate($number, $callback = null, $account = null)
    {
        if (! starts_with($number, '2547')) {
            throw new InvalidArgumentException('The subscriber number must start with 2547');
        }

        $time = Carbon::now()->format('YmdHis');
        $configs = (new ConfigurationRepository)->useAccount($account);

        $shortCode = $configs->getAccountKey('lnmo.shortcode');
        $passkey   = $configs->getAccountKey('lnmo.passkey');
        $callback  = $configs->getAccountKey('lnmo.callback');

        $defaultCallback = $configs->getAccountKey('id_validation_callback');
        $initiator = $configs->getAccountKey('initiator');

        $body = [
            'Initiator'         => $initiator,
            'BusinessShortCode' => $shortCode,
            'Password'          => $this->getPassword($shortCode, $passkey, $time),
            'Timestamp'         => $time,
            'TransactionType'   => 'CheckIdentity',
            'PhoneNumber'       => $number,
            'CallBackURL'       => $callback ?: $defaultCallback,
            'TransactionDesc'   => ' '
        ];

        try {
            $response = $this->makeRequest(
                $body,
                Core::instance()->getEndpoint(MpesaConstant::MPESA_ID_CHECK, $account),
                $account
            );

            return json_decode($response->getBody());
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody());
        }
    }
}
