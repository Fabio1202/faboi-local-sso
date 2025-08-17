<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Contracts\AuthorizationViewResponse;
use Laravel\Passport\Http\Responses\SimpleViewResponse;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    #[\Override]
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Passport::hashClientSecrets();
        Passport::viewPrefix('passport');

        // Register PasskeyService
        $this->app->singleton(\App\Services\Auth\PasskeyService::class, function () {
            return new \App\Services\Auth\PasskeyService;
        });
    }
}
