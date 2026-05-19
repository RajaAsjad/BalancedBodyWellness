<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        $compiledViews = config('view.compiled');
        if (is_string($compiledViews) && $compiledViews !== '' && ! is_dir($compiledViews)) {
            @mkdir($compiledViews, 0755, true);
        }

        $home_page_data = globalData();
        View::share('home_page_data', $home_page_data);
    }
}
