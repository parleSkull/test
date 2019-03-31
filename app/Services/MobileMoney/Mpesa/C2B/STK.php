<?php

namespace App\Services\MobileMoney\Mpesa\C2B;

use App\Models\MobileMoney\Mpesa\C2B\STKErrorResponse;
use App\Models\MobileMoney\Mpesa\C2B\STKRequest;
use App\Models\MobileMoney\Mpesa\C2B\STKSuccessResponse;
use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use App\Services\MobileMoney\Mpesa\Engine\Core;
use App\Services\MobileMoney\Mpesa\Repositories\ConfigurationRepository;
use App\Services\MobileMoney\Mpesa\Traits\MakesRequest;

/**
 * Class STK.
 */
class STK
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
     * The transaction reference
     *
     * @var string
     */
    protected $reference;

    /**
     * The transaction description
     *
     * @var string
     */
    protected $description;

    /**
     * The MPesa account to be used.
     *
     * @var string
     */
    protected $account = null;

    /**
     * The unique command that specifies C2B transaction type
     *
     * @var string
     */
    protected $commandId;

    /**
     * The unique command that specifies C2B transaction type
     *
     * @var STKRequest
     */
    protected $requestModel;

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
     * Set the request amount to be deducted.
     *
     * @param int $amount
     *
     * @return self
     */
    public function request($amount)
    {
        if (!is_numeric($amount)) {
            throw new InvalidArgumentException('The amount must be numeric');
        }

        $this->amount = $amount;

        return $this;
    }

    /**
     * Set the Mobile Subscriber Number to deduct the amount from.
     * Must be in format 2547XXXXXXXX.
     *
     * @param int $number
     *
     * @return self
     */
    public function from($number)
    {
        if (! starts_with($number, '2547')) {
            throw new InvalidArgumentException('The subscriber number must start with 2547');
        }

        $this->number = $number;

        return $this;
    }

    /**
     * Set the product reference number to bill the account.
     *
     * @param int    $reference
     * @param string $description
     *
     * @return self
     */
    public function usingReference($reference, $description)
    {
        $this->reference   = $reference;
        $this->description = $description;

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
    public function payAs($commandId = MpesaConstant::TRANSACTIONTYPE_CUSTOMER_PAYBILL_ONLINE)
    {
        $this->commandId = $commandId;

        return $this;
    }

    /**
     * Set the account to be used.
     *
     * @param $requestModel
     * @return self
     */
    public function updateModel($requestModel)
    {
        $this->requestModel = $requestModel;

        return $this;
    }

    /**
     * Prepare the STK Push request
     *
     * @param int $amount
     * @param int $number
     * @param null $commandId
     * @param null $uuid
     * @param null $requestModel
     * @param string $reference
     * @param string $description
     * @param string $account
     *
     * @return mixed
     * @throws \App\Services\MobileMoney\Mpesa\Exceptions\ConfigurationException
     * @throws \App\Services\MobileMoney\Mpesa\Exceptions\ErrorException
     * @throws \Exception
     */
    public function push($amount = null, $number = null, $commandId = null, $uuid = null, $requestModel = null, $reference = null, $description = null, $account = null)
    {
        $account = $account ?: $this->account;
        $time = Carbon::now()->format('YmdHis');
//        $time = now()->format('YmdHms');
        $configs = (new ConfigurationRepository)->useAccount($account);

        $shortCode = $configs->getAccountKey('lnmo.short_code');
        $passkey   = $configs->getAccountKey('lnmo.passkey');
        $callback  = $configs->getAccountKey('lnmo.callback_custom');
        $password = $this->getPassword($shortCode, $passkey, $time);

        Log::debug('Callback url '.$callback);
        Log::debug('password '.$password);
        Log::debug('timestamp '.$time);

        $body = [
            'BusinessShortCode' => $shortCode,
            'Password'          => $password,
            'Timestamp'         => $time,
            'TransactionType'   => $commandId ?: $this->commandId,
            'Amount'            => $amount ?: $this->amount,
            'PartyA'            => $number ?: $this->number,
            'PartyB'            => $shortCode,
            'PhoneNumber'       => $number ?: $this->number,
            'CallBackURL'       => $callback,
            'AccountReference'  => $reference ?: $this->reference,
            'TransactionDesc'   => $description ?: $this->description,
        ];

        $model = $requestModel ?: $this->requestModel;
        $model->update([
            'BusinessShortCode' => $shortCode,
            'Timestamp' => $time,
            'TransactionType' => $commandId ?: $this->commandId
        ]);
        $model->save();

        try {
            $response = $this->makeRequest(
                $body,
                Core::instance()->getEndpoint(MpesaConstant::MPESA_C2B_LNMO, $account),
                $account
            );

            return $this->processResponse($model, $response->getStatusCode(), json_decode($response->getBody(),true));
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody(),true);
        }
    }

    /*
     * Process Response
     */
    public function processResponse($stkRequest, $statusCode, $body){
        $response = [
            'response_type' => null,
            'response_body' => null
        ];
        if($statusCode != 200){
            $errorResponse = STKErrorResponse::create($body);
            $stkRequest->update([
                'response_id' => $errorResponse->id,
                'response_type' => 'stkErrorResponse'
            ]);
            $response = [
                'response_type' => 'stkErrorResponse',
                'response_body' => $errorResponse
            ];
        }else{
            $successResponse = STKSuccessResponse::create($body);
            $stkRequest->update([
                'response_id' => $successResponse->id,
                'response_type' => 'stkSuccessResponse'
            ]);
            $response = [
                'response_type' => 'stkSuccessResponse',
                'response_body' => $successResponse
            ];
        }
        return $response;
    }

    /**
     * Validate an initialized transaction.
     *
     * @param string $checkoutRequestID
     *
     * @param null $account
     * @return json
     * @throws \Exception
     */
    public function validate($checkoutRequestID, $account = null)
    {
        $account = $account ?: $this->account;
        $time = Carbon::now()->format('YmdHis');
        $configs = (new ConfigurationRepository)->useAccount($account);

        $shortCode = $configs->getAccountKey('lnmo.shortcode');
        $passkey   = $configs->getAccountKey('lnmo.passkey');

        $body = [
            'BusinessShortCode' => $shortCode,
            'Password'          => $this->getPassword($shortCode, $passkey, $time),
            'Timestamp'         => $time,
            'CheckoutRequestID' => $checkoutRequestID,
        ];

        try {
            $response = $this->makeRequest(
                $body,
                Core::instance()->getEndpoint(MpesaConstant::MPESA_C2B_LNMO_VALIDATE, $account),
                $account
            );

            return json_decode($response->getBody());
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody());
        }
    }
}
