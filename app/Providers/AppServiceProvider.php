<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Schema::defaultStringLength(191);
            \View::composer('*', function($view) {

                $channels= \Cache::rememberForever('channels',function(){
                    return \App\Channel::all();
                });

                $view->with('channels',$channels);
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
