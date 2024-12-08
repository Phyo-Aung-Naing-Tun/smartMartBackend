<?php

namespace App\Providers;

use App\Contracts\FailToBan\FailToBanLogServiceInterface;
use App\Contracts\FailToBan\FailToBanServiceInterface;
use App\Http\Responses\BaseResponse;
use App\Services\FailToBan\FailToBanLogService;
use App\Services\FailToBan\FailToBanService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        //Rate Limiters

         //to limit the request of login/register/requestOtp.... route
        RateLimiter::for('auth',function(Request $request){
            return Limit::perMinute(10)->by($request->getUserIp())->response(function(){
                return (new BaseResponse)->error('Too Many Request',429);
            });
        });
        // ***

        //Request Macros
        Request::macro('getUserIp',function(){
            return $this->header('X-CLIENT-IP') ?? '12345';
        });
        // ***


        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}