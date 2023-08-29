<?php

namespace App\Providers;

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
        // if APP_ENV == local, Debugbar is enabled
        if (env('APP_ENV') == 'local') {
            \Debugbar::enable();
        } else {
            \Debugbar::disable();
        }
    }
}
