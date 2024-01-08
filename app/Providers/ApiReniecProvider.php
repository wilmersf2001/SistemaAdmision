<?php

namespace App\Providers;

use App\Services\ApiReniecService;
use Illuminate\Support\ServiceProvider;


class ApiReniecProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiReniecService::class, function ($app) {
            return new ApiReniecService(env('API_RENIEC_TOKEN'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
