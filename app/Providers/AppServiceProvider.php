<?php

namespace App\Providers;

use App\Services\LlamaApi;
use App\Services\LlamaApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LlamaApiService::class, function ($app) {
            return new LlamaApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
