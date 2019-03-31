<?php

namespace App\Services\MobileMoney\Mpesa\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Simulate.
 *
 * @see \App\Services\MobileMoney\Mpesa\C2B\Simulate
 */
class Simulate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mp_simulate';
    }
}
