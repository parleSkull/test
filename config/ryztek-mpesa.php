<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Account
    |--------------------------------------------------------------------------
    |
    | This is the default account to be used when none is specified.
    */

    'default' => 'staging',

    /*
    |--------------------------------------------------------------------------
    | Native File Cache Location
    |--------------------------------------------------------------------------
    |
    | When using the Native Cache driver, this will be the relative directory
    | where the cache information will be stored.
    */

    'cache_location' => '../cache',

    /*
    |--------------------------------------------------------------------------
    | Accounts
    |--------------------------------------------------------------------------
    |
    | These are the accounts that can be used with the package. You can configure
    | as many as needed. Two have been setup for you.
    |
    | Sandbox: Determines whether to use the sandbox, Possible values: sandbox | production
    | Initiator: This is the username used to authenticate the transaction request
    | LNMO:
    |    shortcode: The till number
    |    passkey: The passkey for the till number
    |    callback: Endpoint that will be be queried on completion or failure of the transaction.
    |
    */

    'accounts' => [
        'staging' => [
            'sandbox' => true,
            'key' => 'OrAR90GIAuVcsSdc2dfoDwqtau6AcFlj',
            'secret' => 'R2GN7Cr6jM8uzuRq',
            'short_code1' => '603081',
            'short_code2' => '600000',
            'initiator' => 'apisaf',
            'security_credential' => '19956',
            'queue_timeout_url_path' => 'mpesa/queue-timeout',
            'result_url_path' => 'mpesa/result',
            'id_validation_path' => 'mpesa/id-callback',
            'lnmo' => [
                'short_code' => 174379,
                'passkey' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
                'callback' => 'api/mpesa/stk-result',
                'callback_custom' => "http://45.33.113.193:80/api/mpesa/stk-result"
            ]
        ],

        'production' => [
            'sandbox' => false,
            'key' => '',
            'secret' => '',
            'initiator' => 'apitest363',
            'id_validation_callback' => 'http://example.com/callback?secret=some_secret_hash_key',
            'lnmo' => [
                'shortcode' => 174379,
                'passkey' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
                'callback' => 'http://example.com/callback?secret=some_secret_hash_key',
            ]
        ],
    ],
];
