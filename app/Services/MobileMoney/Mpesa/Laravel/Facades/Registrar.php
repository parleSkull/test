<?php

namespace App\Services\MobileMoney\Mpesa\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Registrar.
 *
 * @see \App\Services\MobileMoney\Mpesa\C2B\Registrar
 */
class Registrar extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mp_registrar';
    }
}
