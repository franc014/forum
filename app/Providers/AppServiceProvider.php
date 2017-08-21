<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //view composer, can be placed in other service provider

        //1 view
        /*View::composer('threads.create',function ($view){
            $view->with('channels',Channel::all());
        });*/

        //2 view
       /* View::composer(['threads.index','threads.create'],function ($view){
            $view->with('channels',Channel::all());
        });*/

        //all views
        View::composer('*',function ($view){
            $view->with('channels',Channel::all());
        });

            //or
            //View::share('channels',Channel::all());

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
