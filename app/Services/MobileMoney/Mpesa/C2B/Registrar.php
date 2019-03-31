<?php

namespace App\Services\MobileMoney\Mpesa\C2B;

use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use Exception;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use App\Services\MobileMoney\Mpesa\Engine\Core;
use App\Services\MobileMoney\Mpesa\Traits\MakesRequest;

/**
 * Class Registrar.
 */
class Registrar
{
    use MakesRequest;

    /**
     * The short code to register callbacks for.
     *
     * @var string
     */
    protected $shortCode;

    /**
     * The validation callback.
     *
     * @var
     */
    protected $validationURL;

    /**
     * The confirmation callback.
     *
     * @var
     */
    protected $confirmationURL;

    /**
     * The status of the request in case a timeout occurs.
     *
     * @var string
     */
    protected $onTimeout = 'Completed';

    /**
     * The account to be used
     *
     * @var string
     */
    protected $account = null;

    /**
     * Submit the short code to be registered.
     *
     * @param $shortCode
     *
     * @return $this
     */
    public function register($shortCode)
    {
        $this->shortCode = $shortCode;

        return $this;
    }

    /**
     * Submit the callback to be used for validation.
     *
     * @param $validationURL
     *
     * @return $this
     */
    public function onValidation($validationURL)
    {
        $this->validationURL = $validationURL;

        return $this;
    }

    /**
     * Submit the callback to be used for confirmation.
     *
     * @param $confirmationURL
     *
     * @return $this
     */
    public function onConfirmation($confirmationURL)
    {
        $this->confirmationURL = $confirmationURL;

        return $this;
    }

    /**
     * Set the transaction status on timeout.
     *
     * @param string $onTimeout
     *
     * @return $this
     */
    public function onTimeout($onTimeout = 'Completed')
    {
        if ($onTimeout != 'Completed' && $onTimeout != 'Cancelled') {
            throw new InvalidArgumentException('Invalid timeout argument. Use Completed or Cancelled');
        }

        $this->onTimeout = $onTimeout;

        return $this;
    }

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
     * Initiate the registration process.
     *
     * @param null $shortCode
     * @param null $confirmationURL
     * @param null $validationURL
     * @param null $onTimeout
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function submit($shortCode = null, $confirmationURL = null, $validationURL = null, $onTimeout = null, $account = null)
    {
        $account = $account ?: $this->account;

        if ($onTimeout) {
            $this->onTimeout($onTimeout);
        }

        $body = [
            'ShortCode'       => $shortCode ?: $this->shortCode,
            'ResponseType'    => $onTimeout ?: $this->onTimeout,
            'ConfirmationURL' => $confirmationURL ?: $this->confirmationURL,
            'ValidationURL'   => $validationURL ?: $this->validationURL
        ];

        try {
            $response = $this->makeRequest(
                $body,
                Core::instance()->getEndpoint(MpesaConstant::MPESA_C2B_REGISTER, $account),
                $account
            );

            return \json_decode($response->getBody());
        } catch (RequestException $exception) {
            $message = $exception->getResponse() ?
               $exception->getResponse()->getReasonPhrase() :
               $exception->getMessage();

            throw new Exception($message);
        }
    }
}
