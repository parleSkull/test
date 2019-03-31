<?php

namespace App\Services\MobileMoney\Mpesa\Engine;

use App\Services\MobileMoney\Mpesa\Support\MpesaConstant;
use Exception;
use GuzzleHttp\ClientInterface;
use App\Services\MobileMoney\Mpesa\Auth\Authenticator;
use App\Services\MobileMoney\Mpesa\Contracts\CacheStore;
use App\Services\MobileMoney\Mpesa\Contracts\ConfigurationStore;
use App\Services\MobileMoney\Mpesa\Repositories\ConfigurationRepository;

/**
 * Class Core.
 */
class Core
{
    /**
     * @var ConfigurationStore
     */
    private $config;

    /**
     * @var CacheStore
     */
    private $cache;

    /**
     * @var Core
     */
    protected static $instance;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * Core constructor.
     *
     * @param ClientInterface    $client
     * @param ConfigurationStore $configStore
     * @param CacheStore         $cacheStore
     */
    public function __construct(ClientInterface $client, ConfigurationStore $configStore, CacheStore $cacheStore)
    {
        $this->config = $configStore;
        $this->cache  = $cacheStore;
        $this->setClient($client);
        $this->initialise();

        self::$instance = $this;
    }

    /**
     * Initialise the Core process.
     */
    private function initialise()
    {
        $this->auth = new Authenticator();
    }

    /**
     * Get the current instance of the Core.
     *
     * @return self
     * @throws Exception
     */
    public static function instance()
    {
        if (!self::$instance) {
            if (!function_exists('app')) {
                throw new Exception('Core not initialised.');
            }

            return app(self::class);
        }

        return self::$instance;
    }

    /**
     * Set HTTP Client.
     *
     * @param ClientInterface $client
     **/
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get the HTTP Client instance.
     */
    public function client()
    {
        return $this->client;
    }

    /**
     * Get the configuration instance.
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * Get the configuration value.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getConfig($key = null, $default = null)
    {
        if (!$key) {
            return $this->config->get('ryztek-mpesa');
        }

        return $this->config->get("ryztek-mpesa.{$key}", $default);
    }

    /**
     * Get the authentication instance
     *
     * @return Authenticator
     */
    public function auth()
    {
        return $this->auth;
    }

    /**
     * Get the cache instance.
     *
     * @return CacheStore
     */
    public function cache()
    {
        return $this->cache;
    }

    /**
     * Get the endpoint relative to the current
     *
     * @param string $endpoint
     * @param string $account
     *
     * @return string
     */
    public function getEndpoint($endpoint, $account = null)
    {
        $isSandbox = (new ConfigurationRepository)->getAccountKey('sandbox', true, $account);

        if ($isSandbox) {
            return $this->resolveUrl(MpesaConstant::MPESA_SANDBOX, $endpoint);
        }

        return $this->resolveUrl(MpesaConstant::MPESA_PRODUCTION, $endpoint);
    }

    /**
     * Resolve the provided URL
     *
     * @param string $base
     * @param string $key
     *
     * @return string
     */
    private function resolveUrl($base, $key)
    {
        return $base . trim($key, '/');
    }
}
