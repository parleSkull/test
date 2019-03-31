<?php

namespace App\Services\MobileMoney\Mpesa\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class STK
 *
 * @category PHP
 *
 * @see \App\Services\MobileMoney\Mpesa\C2B\STK
 */
class STK extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mp_stk';
    }
}
