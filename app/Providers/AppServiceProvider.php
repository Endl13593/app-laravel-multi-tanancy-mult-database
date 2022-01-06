<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('tenant', function () {
            return request()->getHost() !== config('tenant.domain_main');
        });

        Blade::if('tenantmain', function () {
            return request()->getHost() === config('tenant.domain_main');
        });
    }
}
