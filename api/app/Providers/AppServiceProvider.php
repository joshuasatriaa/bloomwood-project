<?php

namespace App\Providers;

use App\Services\Contracts\ImageServiceContract;
use App\Services\Contracts\PaymentGatewayContract;
use App\Services\ImageService;
use App\Services\MidtransService;
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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(
            ImageServiceContract::class,
            ImageService::class
        );

        $this->app->bind(
            PaymentGatewayContract::class,
            MidtransService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
