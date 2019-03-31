<?php

namespace App\Services\MobileMoney\Mpesa\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class STK
 *
 * @see \App\Services\MobileMoney\Mpesa\B2C\PayOut
 */
class PayOut extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mp_payout';
    }
}
