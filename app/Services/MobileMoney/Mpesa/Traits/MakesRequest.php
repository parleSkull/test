<?php

namespace App\Services\MobileMoney\Mpesa\Traits;

use App\Services\MobileMoney\Mpesa\Engine\Core;
use Illuminate\Support\Facades\Storage;

trait MakesRequest
{
    /**
     * Initiate the request.
     *
     * @param array $body
     * @param string $endpoint
     * @param string $account
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \App\Services\MobileMoney\Mpesa\Exceptions\ConfigurationException
     * @throws \App\Services\MobileMoney\Mpesa\Exceptions\ErrorException
     * @throws \Exception
     */
    private function makeRequest($body, $endpoint, $account = null)
    {
        return Core::instance()->client()
            ->request(
                'POST',
                $endpoint,
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . Core::instance()->auth()->authenticate($account),
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => $body,
                ]
            );
    }

    /**
     * Get the password for the
     *
     * @param string $shortCode
     * @param string $passkey
     * @param string $time
     *
     * @return string
     */
    private function getPassword($shortCode, $passkey, $time)
    {
        return base64_encode($shortCode . $passkey . $time);
    }

    /*
     * Get Request parameter Security Credential
     */
    function getSecurityCredential($rawPassword)
    {
        $publicKey = Storage::disk('local')->get('mpesa_public_key_cert.cer');
        $encrypted = null;
        openssl_public_encrypt($rawPassword, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
        return base64_encode($encrypted);
    }
}
