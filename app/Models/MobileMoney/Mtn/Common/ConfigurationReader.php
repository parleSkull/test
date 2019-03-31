<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/20/2019
 * Time: 19:46
 */

namespace App\Models\MobileMoney\mtn\Common;

class ConfigurationReader
{
    public static function getProperty($key)
    {
        return config("ryztek-mobilemoney.mtn.{$key}");
    }
}
