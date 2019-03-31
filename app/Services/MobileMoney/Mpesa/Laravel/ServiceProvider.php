<?php

namespace App\Services\MobileMoney\Mpesa\Laravel;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider as RootProvider;
use App\Services\MobileMoney\Mpesa\B2C\PayOut;
use App\Services\MobileMoney\Mpesa\C2B\Identity;
use App\Services\MobileMoney\Mpesa\C2B\Registrar;
use App\Services\MobileMoney\Mpesa\C2B\Simulate;
use App\Services\MobileMoney\Mpesa\C2B\STK;
use App\Services\MobileMoney\Mpesa\Contracts\CacheStore;
use App\Services\MobileMoney\Mpesa\Contracts\ConfigurationStore;
use App\Services\MobileMoney\Mpesa\Engine\Core;
use App\Services\MobileMoney\Mpesa\Laravel\Stores\LaravelCache;
use App\Services\MobileMoney\Mpesa\Laravel\Stores\LaravelConfig;

class ServiceProvider extends RootProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
//        $this->publishes([
//            __DIR__ . '/../../../config/ryztek-mpesa.php' => config_path('ryztek-mpesa.php')
//        ]);
    }

    /**
     * Registrar the application services.
     */
    public function register()
    {
        $this->bindInstances();

        $this->registerFacades();
    }

    private function bindInstances()
    {
        $this->app->bind(ConfigurationStore::class, LaravelConfig::class);
        $this->app->bind(CacheStore::class, LaravelCache::class);
        $this->app->bind(Core::class, function ($app) {
            $config = $app->make(ConfigurationStore::class);
            $cache = $app->make(CacheStore::class);

            return new Core(new Client, $config, $cache);
        });
    }

    private function registerFacades()
    {
        $this->app->bind('mp_payout', function () {
            return $this->app->make(PayOut::class);
        });

        $this->app->bind('mp_stk', function () {
            return $this->app->make(STK::class);
        });

        $this->app->bind('mp_registrar', function () {
            return $this->app->make(Registrar::class);
        });

        $this->app->bind('mp_identity', function () {
            return $this->app->make(Identity::class);
        });

        $this->app->bind('mp_simulate', function () {
            return $this->app->make(Simulate::class);
        });
    }
}
