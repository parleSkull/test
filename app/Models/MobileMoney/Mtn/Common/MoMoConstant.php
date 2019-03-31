<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:47
 */

namespace App\Models\MobileMoney\mtn\Common;

class MoMoConstant
{
//    public const REQPAYEMENTURL = ConfigurationReader::getProperty("REQPAYEMENTURL");
    public static function getReqPaymentUrl(){
        return config("ryztek-mobilemoney.mtn.REQPAYEMENTURL");
    }
//    public const REQDEPOSITURL = ConfigurationReader::getProperty( "REQDEPOSITURL");
    public static function getReqDepositUrl(){
        return config("ryztek-mobilemoney.mtn.REQDEPOSITURL");
    }
//    public static VERSION = ConfigurationReader::getProperty( "ECW_VERSION");
    public static function getVersion(){
        return config("ryztek-mobilemoney.mtn.ECW_VERSION");
    }

    public const NEGTIVE_ONE = -1;

    public const ZERO = 0;

    public const ONE = 1;

    public const TWO = 2;

    public const TWOHUNDRED = 200;

    public const THREE = 3;

    public const FOUR = 4;

    public const FIVE = 5;

    public const SOAPBODY_AMOUNT = "Amount";

    public const SIX = 6;

    public const SEVEN = 7;

    public const EIGHT = 8;

    public const NINE = 9;

    public const TEN = 10;

    public const ELEVEN = 11;

    public const TWELVE = 12;

    public const THIRTEEN = 13;

    public const FOURTEEN = 14;

    public const TWENTY = 20;

    public const HUNDRED = 100;

    public const THOUSAND = 1000;

    public const STR_NEG_ONE = "-1";

    public const STR_ONE = "1";

    public const STR_TWO = "2";

    public const STR_FOUR = "4";

    public const STR_THREE = "3";

    public const THIRTY_TWO = 32;

    public const TIMEOUT_RESULTCODE = "10001005";

    public const EXT_RESPONSE_RESULT = "result";

    public const INVALID_MTCN_ERROR = "J1000";

    public const DEPOSITMOBILEMONEY_TIMEOUT = "100";

    public const RECEIVEPAYMENT_ENDPOINT = "ReceivePaymentUrl";

    public const MOBILEMONEY_VERSION = "mobileMoneyVersion";

    public const MOBILEMONEY1_5 = "1.5";

    public const MOBILEMONEY1_7 = "1.7";

    public const MOBILEMONEY_VENDOR = "mobileMoneyVendor";

    public const MOBILEMONEY_VENDOR_ECW = "ecw";

    public const MOBILEMONEY_VENDOR_FUNDAMO = "fundamo";

    public const CURRENCY_CODE = "currencyCode";

    public const MOBILEMONEY_VENDOR_CONFIG_VALUE = "";

    public const STRONE = "1";

    public const STRZERO = "0";

    public const TRANSACTIONTYPE_VALUE = "5";

    public const OPCO_ID = "opCoID";

    public const EMPTY_STRING = "";

    public const ADDITIONAL_DATA_ERROR = "J1002";

    public const DEPOSIT_SUCCESS = "01";

    //RequestCompletedAPI

    public const PAYMENT_COMPLETE_SUCCESS = "00000000";

    public const PAYMENT_COMPLETE_SUCCESS_DESC = "success";

    public const PAYMENT_COMPLETE_NODATA = "00000001";

    public const PAYMENT_COMPLETE_NODATA_DESC = "No Data";

    public const PAYMENT_COMPLETE_AUTHFAIL = "10000001";

    public const PAYMENT_COMPLETE_AUTHFAIL_DESC = "Authentication failed";

    public const PAYMENT_COMPLETE_SERVICEERROR = "10000099";

    public const PAYMENT_COMPLETE_SERVICEERROR_DESC = "service error";

    /* **************** MoMo Parameter names ******************** */

    /** The Constant SOAPBODY_PROCESSINGNUMBER. */
    public const SOAPBODY_PROCESSINGNUMBER = "ProcessingNumber";

    /** The Constant SOAPBODY_SERVICEID. */
    public const SOAPBODY_SERVICEID = "serviceId";

    /** The Constant SOAPBODY_SENDERID. */
    public const SOAPBODY_SENDERID = "SenderID";

    /** The Constant SOAPBODY_OPCOID. */
    public const SOAPBODY_OPCOID = "OpCoID";

    /** The Constant SOAPBODY_MSISDNNUM. */
    public const SOAPBODY_MSISDNNUM = "MSISDNNum";

    /** The Constant SOAPBODY_ACCTREF. */
    public const SOAPBODY_ACCTREF = "AcctRef";

    /** The Constant SOAPBODY_ACCTBALANCE. */
    public const SOAPBODY_ACCTBALANCE = "AcctBalance";

    /** The Constant SOAPBODY_CURRCODE. */
    public const SOAPBODY_CURRCODE = "CurrCode";

    /** The Constant SOAPBODY_NARRATION. */
    public const SOAPBODY_NARRATION = "Narration";

    /** The Constant SOAPBODY_PREFLANG. */
    public const SOAPBODY_PREFLANG = "PrefLang";

    /** The Constant SOAPBODY_IMSINUM. */
    public const SOAPBODY_IMSINUM = "IMSINum";

    /** The Constant SOAPBODY_ORDERDATETIME. */
    public const SOAPBODY_ORDERDATETIME = "OrderDateTime";

    /** The Constant SOAPBODY_DUEAMOUNT. */
    public const SOAPBODY_DUEAMOUNT = "DueAmount";

    /** The Constant SOAPBODY_MINDUEAMOUNT. */
    public const SOAPBODY_MINDUEAMOUNT = "MinDueAmount";

    /** The Constant SOAPBODY_STATUSCODE. */
    public const SOAPBODY_STATUSCODE = "StatusCode";

    /** The Constant SOAPBODY_STATUSDESC. */
    public const SOAPBODY_STATUSDESC = "StatusDesc";

    /** The Constant SOAPBODY_THIRDPARTYACCTREF. */
    public const SOAPBODY_THIRDPARTYACCTREF = "ThirdPartyAcctRef";

    /** The Constant SOAPBODY_REQUESTAMOUNT. */
    public const SOAPBODY_REQUESTAMOUNT = "RequestAmount";

    /** The Constant SOAPBODY_PAYMENTREF. */
    public const SOAPBODY_PAYMENTREF = "PaymentRef";

    /** The Constant SOAPBODY_THIRDPARTYTRANSACTIONID. */
    public const SOAPBODY_THIRDPARTYTRANSACTIONID = "ThirdPartyTransactionID";

    /* *********************SOAP HEADERS ********************** */
    /** The Constant SOAPHEADER_SPID. */
    public const SOAPHEADER_SPID = "spId";

    /** The Constant SOAPHEADER_SPPASSWORD. */
    public const SOAPHEADER_SPPASSWORD = "spPassword";

    /** The Constant SOAPHEADER_SERVICEID. */
    public const SOAPHEADER_SERVICEID = "serviceId";

    /** The Constant SOAPHEADER_TIMESTAMP. */
    public const SOAPHEADER_TIMESTAMP = "timeStamp";

    /** The Constant SOAPHEADER_OA. */
    public const SOAPHEADER_OA = "OA";

    /** The Constant SOAPHEADER_FA. */
    public const SOAPHEADER_FA = "FA";

    /** The Constant SOAPHEADER_TOKEN. */
    public const SOAPHEADER_TOKEN = "token";

    /** The Constant SOAPHEADER_WATCHER. */
    public const SOAPHEADER_WATCHER = "watcher";

    /** "01" */
    public const STATUS_CODE_SUCCESS = "0";

    /** "LANGUAGE_DEFAULT" */
    public const LANGUAGE_DEFAULT = "en";

    /**
     * MOBILEMONEY SENDER FORMAT variable configured in sce.properties
     */
    public const MOBILEMONEY_SENDER_FORMAT_STR = "MobileMoneySenderFormat";

    /**
     * MOBILEMONEY SENDER FORMAT configured in sce.properties
     */
    public const MOBILEMONEY_SENDER_FORMAT = "";

    /** ECW_PARAM_SERVICEID = 200 */
    public const PARAM_SERVICEID = "fundamoMobileMoneyServiceId";

    /** configured in sce.properties */
    public const PARAM_VALUE = "paramValue";

    /* ******************* Transaction States****************** */

    /** REQUESTPAYMENT_SENT: 0 */
    public const REQUESTPAYMENT_SENT = "0";

    /** CONFIRMTHIRDPARTYPAYMENT_SUCESS: 1 */
    public const CONFIRMTHIRDPARTYPAYMENT_SUCCESS = "1";

    /** CONFIRMTHIRDPARTYPAYMENT_FAILED: 2 */
    public const CONFIRMTHIRDPARTYPAYMENT_FAILED = "2";

    /** REQUESTPAYMENT_SUCCESS: 3 */
    public const REQUESTPAYMENT_SUCCESS = "3";

    /** REQUESTPAYMENT_FAILURE: 4 */
    public const REQUESTPAYMENT_FAILURE = "4";

    /** RECEIEVCONFIRMPAYMENT_SUCCESS: 5 */
    public const RECEIEVCONFIRMPAYMENT_SUCCESS = "5";

    /** RECEIEVCONFIRMPAYMENT_FAILED: 6 */
    public const RECEIEVCONFIRMPAYMENT_FAILED = "6";

    /** RECEIEVCONFIRMPAYMENT_FAILED: 6 */
    public const PARAM_PREFIX = "paramPrefix";

    /** FUNDAMO_USERID: 6 */
    public const FUNDAMO_USERID = "fundamoUserId";

    /** FUNDAMO_PASSWORD: 6 */
    public const FUNDAMO_PASSWORD = "fundamoPassword";

    /** CURRENCYSWICTH_FLAG: 6 */
    public const CURRENCYSWICTH_FLAG = "currencySwicthFlag";

    /** CURRENCYSWICTH_MULTIPLIER: 6 */
    public const CURRENCYSWICTH_MULTIPLIER = "currencySwicthMultiplier";

    /** GETACCOUNTBALANCEURL */
    public const GETACCOUNTBALANCEURL = "GetAccountBalanceUrl";

    /** CURRENCY_TYPE */
    public const CURRENCY_TYPE = "currency";

    /** SENDER */
    public const EXTENSIONINFO_SENDER = "Sender";

    /** EXTENSIONINFO_SRCPARTNERID */
    public const EXTENSIONINFO_SRCPARTNERID = "SrcPartnerID";

    /** EXTENSIONINFO_SRCPARTNERID */
    public const EXTENSIONINFO_DSTPARTNERID = "DstPartnerID";

    /**
     * EXTENSIONINFO_SEEMESSAGEID Value obtained from GetAccountBalance and passing to
     * ReceivePaymentConfirm
     */
    public const EXTENSIONINFO_SEEMESSAGEID = "seeMessageID";

    /** EXTENSIONINFO_SRCPARTNERID */
    public const EXTENSIONINFO_NOTIFYURL = "NotifyURL";

    /** CONFIRMTHIRDPARTY_SENDERID */
    public const CONFIRMTHIRDPARTY_SENDERID = "MOM";

    /** MOM API's supported Pref Languageu */
    public const PREF_LANGUAGE = "localeLanguage";

    /** A predetermined code to determine the status of the transaction String value */
    public const STATUS_CODE_STR = "momStatusCode";

    /**
     * A predetermined code to determine the status of the transaction
     */
    public const STATUS_CODE = "";

    /**
     * CURRENCY_CODE_CONFIG_VALUE in sce.properties
     */
    public const CURRENCY_CODE_CONFIG_VALUE = "";

    /** EXTENSIONINFO_PLATFORM */
    public const EXTENSIONINFO_PLATFORM = "platform";

    /** EXTENSIONINFO_MSISDN */
    public const EXTENSIONINFO_MSISDN = "MSISDN";

    /** EXTENSIONINFO_SPRESOURCEINFO */
    public const EXTENSIONINFO_SPRESOURCEINFO = "SPResourceInfo";

    /** EXTENSIONINFO_CURRENCYCODE */
    public const EXTENSIONINFO_CURRENCYCODE = "currCode";

    /** ECW_STATUS_CODE_SUCCESS */
    public const ECW_STATUS_CODE_SUCCESS = "01";

    /** EXTENSIONINFO_PAYMENTREF */
    public const EXTENSIONINFO_PAYMENTREF = "PaymentRef";
}
