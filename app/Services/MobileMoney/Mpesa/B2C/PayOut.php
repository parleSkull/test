<?php

namespace App\Services\MobileMoney\Mpesa\B2C;

use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use App\Services\MobileMoney\Mpesa\Engine\Core;
use App\Services\MobileMoney\Mpesa\Repositories\ConfigurationRepository;
use App\Services\MobileMoney\Mpesa\Traits\MakesRequest;

/**
 * Class Withdraw.
 */
class PayOut
{
    use MakesRequest;

    /**
     * Unique UUID for transaction
     *
     * @var string
     */
    protected $uuid;

    /**
     * The mobile number
     *
     * @var string
     */
    protected $number;

    /**
     * The amount to request
     *
     * @var int
     */
    protected $amount;

    /**
     * The transaction Remarks
     * Any additional information to be associated with the transaction
     *
     * @var string
     */
    protected $remarks;

    /**
     * The transaction Occassion
     * Any additional information to be associated with the transaction
     *
     * @var string
     */
    protected $occassion;

    /**
     * The unique command that specifies B2C transaction type
     *
     * @var string
     */
    protected $commandId;

    /**
     * The MPesa account to be used.
     *
     * @var string
     */
    protected $account = null;

    /**
     * Set the account to be used.
     *
     * @param string $account
     *
     * @return self
     */
    public function usingAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Set tuniqur tracking uuid on our system
     *
     * @param $uuid
     * @return self
     */
    public function trackBy($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Set the account to be used.
     *
     * @param string $commandId
     *
     * @return self
     */
    public function payAs($commandId = MpesaConstant::COMMANDID_BUSINESS_PAYMENT)
    {
        $this->commandId = $commandId;

        return $this;
    }

    /**
     * Set the request amount to be deducted.
     *
     * @param int $amount
     *
     * @return self
     */
    public function withdraw($amount)
    {
        if (!is_numeric($amount)) {
            throw new InvalidArgumentException('The amount must be numeric');
        }

        $this->amount = $amount;

        return $this;
    }

    /**
     * Set the Mobile Subscriber Number to send the amount to.
     * Must be in format 2547XXXXXXXX.
     *
     * @param int $number
     *
     * @return self
     */
    public function to($number)
    {
        if (! starts_with($number, '2547')) {
            throw new InvalidArgumentException('The subscriber number must start with 2547');
        }

        $this->number = $number;

        return $this;
    }

    /**
     * Set optional remarks and occassion
     *
     * @param $remarks
     * @param $occassion
     * @return self
     */
    public function comment($remarks, $occassion)
    {
        $this->remarks   = $remarks;
        $this->occassion = $occassion;

        return $this;
    }

    /**
     * Prepare the B2C Payment Request
     *
     * @param int $amount
     * @param int $number
     * @param null $commandId
     * @param null $remarks
     * @param null $occassion
     * @param string $account
     *
     * @return mixed
     * @throws \Exception
     */
    public function payOut($amount = null, $number = null, $commandId = null, $uuid = null, $remarks = null, $occassion = null, $account = null)
    {
        $account = $account ?: $this->account;
        $configs = (new ConfigurationRepository)->useAccount($account);

        $initiator = $configs->getAccountKey('initiator');
        $securityCredential = $this->getSecurityCredential($configs->getAccountKey('security_credential'));
        $shortCode = $configs->getAccountKey('short_code');
        $queueTimeOutURL   = url($configs->getAccountKey('queue_timeout_url_path'), ['uuid' => $uuid ?: $this->uuid], false);
        $resultURL  = url($configs->getAccountKey('result_url_path'), ['uuid' => $uuid ?: $this->uuid], false);

        $body = [
            'InitiatorName' => $initiator,
            'SecurityCredential' => $securityCredential,
            'CommandID'         => $commandId ?: $this->commandId,
            'Amount'            => $amount ?: $this->amount,
            'PartyA'            => $shortCode,
            'PartyB'            => $number ?: $this->number,
            'Remarks'       => $remarks?: $this->remarks,
            'QueueTimeOutURL'       => $queueTimeOutURL,
            'ResultURL'  => $resultURL,
            'Occassion'   => $occassion ?: $this->occassion
        ];

        try {
            $response = $this->makeRequest(
                $body,
                Core::instance()->getEndpoint(MpesaConstant::MPESA_B2C_PAYMENT_REQUEST, $account),
                $account
            );

            return json_decode($response->getBody());
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody());
        }
    }
}
