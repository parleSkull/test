<?php

namespace App\Services\MobileMoney\Mpesa\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Identity.
 *
 * @see \App\Services\MobileMoney\Mpesa\C2B\Registrar
 */
class Identity extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mp_identity';
    }
}
