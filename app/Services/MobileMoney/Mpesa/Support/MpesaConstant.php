<?php

namespace App\Services\MobileMoney\Mpesa\Support;

class MpesaConstant
{
    const MPESA_AUTH = 'oauth/v1/generate?grant_type=client_credentials';
    const MPESA_ID_CHECK = 'mpesa/checkidentity/v1/query';

    const MPESA_C2B_REGISTER = 'mpesa/c2b/v1/registerurl';
    const MPESA_C2B_SIMULATE = 'mpesa/c2b/v1/simulate';
    const MPESA_C2B_LNMO = 'mpesa/stkpush/v1/processrequest';
    const MPESA_C2B_LNMO_VALIDATE = 'mpesa/stkpushquery/v1/query';
    const MPESA_B2C_PAYMENT_REQUEST = 'mpesa/b2c/v1/paymentrequest';

    const MPESA_SANDBOX = 'https://sandbox.safaricom.co.ke/';
    const MPESA_PRODUCTION = 'https://api.safaricom.co.ke/';

    const TRANSACTIONTYPE_CUSTOMER_PAYBILL_ONLINE = 'CustomerPayBillOnline';
    const TRANSACTIONTYPE_CUSTOMER_BUYGOODS_ONLINE = 'CustomerBuyGoodsOnline';

    const COMMANDID_SALARY_PAYMENT = 'SalaryPayment';
    const COMMANDID_BUSINESS_PAYMENT = 'BusinessPayment';
    const COMMANDID_PROMOTION_PAYMENT = 'PromotionPayment';

    const MPESA_PUBLIC_KEY_CERT_NAME = 'PromotionPayment';
}