<?php

namespace App\Services\MobileMoney\Mpesa\Auth;

use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use GuzzleHttp\Exception\RequestException;
use App\Services\MobileMoney\Mpesa\Engine\Core;
use App\Services\MobileMoney\Mpesa\Exceptions\ConfigurationException;
use App\Services\MobileMoney\Mpesa\Exceptions\ErrorException;
use App\Services\MobileMoney\Mpesa\Repositories\ConfigurationRepository;

/**
 * Class Authenticator.
 */
class Authenticator
{
    /**
     * Cache key.
     */
    const AC_TOKEN = 'MP:';

    /**
     * Get the access token required to transact.
     *
     * @param string $account
     *
     * @return mixed
     *
     * @throws ConfigurationException
     * @throws ErrorException
     * @throws \Exception
     */
    public static function authenticate($account = null)
    {
        $configs = (new ConfigurationRepository)->useAccount($account);
        $key = $configs->getAccountKey('key');
        $secret = $configs->getAccountKey('secret');
        $cacheKey = self::AC_TOKEN . "{$key}{$secret}";

        if ($token = Core::instance()->cache()->get($cacheKey)) {
            return $token;
        }

        try {
            $response = self::makeRequest($key, $secret, $account);
            $body = json_decode($response->getBody());
            self::saveCredentials($cacheKey, $body);

            return $body->access_token;
        } catch (RequestException $exception) {
            $message = $exception->getResponse() ?
               $exception->getResponse()->getReasonPhrase() :
               $exception->getMessage();

            throw self::generateException($message);
        }
    }

    /**
     * Initiate the authentication request.
     *
     * @param $key
     * @param $secret
     * @param $account
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    private static function makeRequest($key, $secret, $account)
    {
        $credentials = base64_encode($key . ':' . $secret);
        $endpoint = Core::instance()->getEndpoint(MpesaConstant::MPESA_AUTH, $account);

        return Core::instance()->client()->request('GET', $endpoint, [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    /**
     * Store the credentials in the cache.
     *
     * @param $key
     * @param $credentials
     * @throws \Exception
     */
    private static function saveCredentials($key, $credentials)
    {
        $ttl = ($credentials->expires_in / 60) - 2;

        Core::instance()->cache()->put($key, $credentials->access_token, $ttl);
    }

    /**
     * Throw a contextual exception.
     *
     * @param $reason
     *
     * @return ErrorException|ConfigurationException
     */
    private static function generateException($reason)
    {
        switch (strtolower($reason)) {
            case 'bad request: invalid credentials':
                return new ConfigurationException('Invalid consumer key and secret combination');
            default:
                return new ErrorException($reason);
        }
    }
}
