<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        // Set Carbon locale to Indonesian
        Carbon::setLocale('id');
        // Set the default timezone to Asia/Jayapura
        date_default_timezone_set('Asia/Makassar');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
