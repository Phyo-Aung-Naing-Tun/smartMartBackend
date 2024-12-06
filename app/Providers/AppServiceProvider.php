<?php

namespace App\Providers;

use App\Contracts\FailToBan\FailToBanLogServiceInterface;
use App\Contracts\FailToBan\FailToBanServiceInterface;
use App\Services\FailToBan\FailToBanLogService;
use App\Services\FailToBan\FailToBanService;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FailToBanServiceInterface::class,FailToBanService::class);
        $this->app->bind(FailToBanLogServiceInterface::class,FailToBanLogService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}