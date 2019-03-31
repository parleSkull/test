<?php

namespace App\Services\MobileMoney\Mpesa\Contracts;

/**
 * Interface ConfigurationStore
 */
interface ConfigurationStore
{
    /**
     * Get the configuration value from the store or a default value to be supplied.
     *
     * @param $key
     * @param $default
     *
     * @return mixed
     */
    public function get($key, $default = null);
}
