<?php

return [
    'mtn' => [
        'primary_key' => env('MTN_PRIMARY_KEY'),
        'secondary_key' => env('MTN_SECONDARY_KEY'),
        'user_id' => env('MTN_USER_ID'),
        'user_key' => env('MTN_USER_KEY'),
        'callback_url' => env('MOBILE_MONEY_CALLBACK_URL'),

        //RequestPayment URL
        'REQPAYEMENTURL' => 'http://192.168.10.1:8088/mockUMMServicePortBinding',

//Request Payment Deposit URL
        'REQDEPOSITURL' => 'http://10.18.212.149:8085/mockUMMServicePortBinding',

//Mobile Money ECW Version(1.5/1.7)
        'ECW_VERSION' => 1.7,

//Header Details
//Service Partner ID
        'spId' => 35000004,

//Service Partner Password
        'spPassword' => 'bmeB500',

//Service ID
        'serviceId' => 3500001,

//Sender ID
        'senderId' => 452,

//Bundle ID
        'bundleID' => 123,

//Request Body Information(Both Payment & Deposit)
//Minimum due amount for request payment API
        'minDueAmount' => 0,

//Opco ID
        'opCoId' => 23,

//Prefered Language
        'prefLang' => 'En',

//Narration details
        'narration' => "add payment",

//Order time for deposit money
        'orderDateTime' => 124585123,

//User IMSI number for Deposit Money
        'imsiNum' => 552,

//Currency Code
        'currencyCode' => 22

    ],
];