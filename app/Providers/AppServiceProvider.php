<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Resource::withoutWrapping();

        Relation::morphMap([
            'stkErrorResponse' => 'App\Models\MobileMoney\Mpesa\C2B\STKErrorResponse',
            'stkSuccessResponse' => 'App\Models\MobileMoney\Mpesa\C2B\STKSuccessResponse',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
