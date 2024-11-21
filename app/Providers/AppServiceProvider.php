<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
    // public function boot()
    // {
    //     //
    //     Schema::defaultStringLength(191);

    // }
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        if (app()->environment('prod')) {
            URL::forceScheme('https');
            URL::forceRootUrl(config('app.url'));
        }

    }

}
