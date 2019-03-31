<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:47
 */

namespace App\Models\MobileMoney\mtn\Common;

abstract class ErrorCodeConstants
{
    // Error codes

    /** transaction Success "1" */
    public static const ERRCODE_1 = "01";

    /** ERRCODE_2 = "2" */
    public static const ERRCODE_2 = "02";

    /** ERRCODE_3 = "3" */
    public static const ERRCODE_3 = "03";

    /** ERRCODE_4 = "4" */
    public static const ERRCODE_4 = "04";

    /** ERRCODE_5 = "5" */
    public static const ERRCODE_5 = "05";

    /** ERRCODE_6 = "6" */
    public static const ERRCODE_6 = "06";

    /** ERRCODE_7 = "7" */
    public static const ERRCODE_7 = "07";

    /** ERRCODE_8 = "8" */
    public static const ERRCODE_8 = "08";

    /** ERRCODE_100 = "100" */
    public static const ERRCODE_100 = "100";

    /** ERRCODE_101 = "101" */
    public static const ERRCODE_101 = "101";

    /** ERRCODE_102 = "102" */
    public static const ERRCODE_102 = "102";

    /** ERRCODE_103 = "103" */
    public static const ERRCODE_103 = "103";

    // Error Descriptions

    /** Successfully processed transaction */
    public static const ERRDESCRIPTION_1 = "Successfully processed transaction";

    /** Invalid account details */
    public static const ERRDESCRIPTION_2 = "Invalid account details";

    /** Transaction not allowed */
    public static const ERRDESCRIPTION_3 = "Transaction not allowed";

    /** Payment below minimum */
    public static const ERRDESCRIPTION_4 = "Payment below minimum";

    /** Invalid Fundamo userid/password */
    public static const ERRDESCRIPTION_5 = "Invalid Fundamo userid/password";

    /** Payment Entry not found */
    public static const ERRDESCRIPTION_6 = "Payment Entry not found";

    /** Missing transaction/message ID */
    public static const ERRDESCRIPTION_7 = "Missing transaction/message ID";

    /** Missing application version */
    public static const ERRDESCRIPTION_8 = "Missing application version";

    /** General failure */
    public static const ERRDESTION_100 = "General failure";

    /** Field length exceeded */
    public static const ERRDESTION_101 = "Field length exceeded";

    /** Subscriber could not be identified. (Invalid subscriberID) */
    public static const ERRDESTION_102 = "Subscriber could not be identified. (Invalid subscriberID)";

    /** Duplicate transaction id */
    public static const ERRDESTION_103 = "Duplicate transaction id";
}
