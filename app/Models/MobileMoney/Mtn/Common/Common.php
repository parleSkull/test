<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:45
 */

namespace App\Models\MobileMoney\mtn\Common;

use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class Common
{
    private const COUNTEREND = 999;

    private const COUNTERBEGIN = 100;

    private const NINEHUNDRED = 900;

    private const NINEHUNDREDNINETY = 990;

    private static $counter = MoMoConstant::HUNDRED;

    private static $r;

    public static function checkNull($strSource): Boolean
    {
        return is_null($strSource);
    }

    public static function checkNullorEmpty($strSource): Boolean
    {
        return is_null($strSource) || strlen(trim($strSource)) == 0;
    }

    public static function getSimpleMsisdn($address): String
    {

        $countryCode = "";

        if (Str::startsWith($address, $countryCode))
        {
            $address = substr($address, 0, strlen($countryCode));
            return $address;
        }

        if (Str::startsWith($address, MoMoConstant::STRZERO))
        {
            $address = substr($address, 0, strlen(MoMoConstant::STRZERO));
            return $address;
        }

        return $address;
    }

    public static function formatCountryCode($phoneNumber, $format, $opCoId): String
    {

        $countryCode =""; /*ServiceCacheUtil.getInstance().getOpCoInfoById(opCoId).getCountryCode();*/

        if (Str::startsWith($phoneNumber, $countryCode))
        {
            $countryCode = MoMoConstant::EMPTY_STRING;
        }

        $formatedPhoneNumber = str_replace("{2}", $phoneNumber, str_replace("{1}", $countryCode, str_replace("{0}", "0", $format)));

        return $formatedPhoneNumber;
    }

    public static function generateMoMUniqueIdentifier(): String
    {
        $processingNum = now()->timestamp;
        $randomNum = "000";

        $mod = 0;
        $rn = 0;
        self::$r = rand(MoMoConstant::ONE, MoMoConstant::HUNDRED);
        $rn = rand(self::$r, MoMoConstant::THOUSAND);

        $mod = MoMoConstant::THOUSAND - $rn;
        if ($mod > self::NINEHUNDREDNINETY)
        {
            $rn = $rn * MoMoConstant::HUNDRED;
        }
        else if ($mod > self::NINEHUNDRED)
        {
            $rn = $rn * MoMoConstant::TEN;
        }

        if (!($rn % MoMoConstant::THOUSAND == MoMoConstant::ZERO))
        {
            $randomNum = "{$rn}";
        }

        if (self::COUNTEREND == self::$counter)
        {
            self::$counter = self::COUNTERBEGIN;
        }

        self::$counter++;

// format : timestamp + randomNum+ unique 4 digit number in sequence
        return substr($processingNum, MoMoConstant::FOUR, MoMoConstant::TWELVE) . $randomNum . self::$counter;
    }
}