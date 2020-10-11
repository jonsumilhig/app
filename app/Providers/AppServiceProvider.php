<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\TwoFactorAuthenticationProvider as TwoFactorAuthenticationProviderContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            TwoFactorAuthenticationProviderContract::class,
            TwoFactorAuthenticationProvider::class,
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
