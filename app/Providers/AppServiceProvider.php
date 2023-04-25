<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// inport paginator for use bootstrap paginator
use Illuminate\Pagination\Paginator;

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
        // function for use bootstrap paginator 
        Paginator::useBootstrap();
    }
}
