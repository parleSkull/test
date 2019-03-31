<?php

namespace App\Services\MobileMoney\Mpesa\Repositories;

use Exception;
use App\Services\MobileMoney\Mpesa\Engine\Core;

/**
 * Class ConfigurationRepository.
 */
class ConfigurationRepository
{
    /**
     * @var string
     */
    private $account;

    /**
     * Set the account to be used when resoving configs.
     *
     * @param string $account
     *
     * @return self
     * @throws Exception
     */
    public function useAccount($account = null)
    {
        $account = $account ?: Core::instance()->getConfig('default');

        if (!Core::instance()->getConfig("accounts.{$account}")) {
            throw new Exception('Invalid account selected');
        }

        $this->account = $account;

        return $this;
    }

    /**
     * Get a configuration value from the store.
     *
     * @param string $key
     * @param mixed $default
     * @param string $account
     *
     * @return mixed
     * @throws Exception
     */
    public function getAccountKey($key, $default = null, $account = null)
    {
        if (!$this->account || ($account && $account !== $this->account)) {
            $this->useAccount($account);
        }

        return Core::instance()->getConfig("accounts.{$this->account}.{$key}", $default);
    }
}
