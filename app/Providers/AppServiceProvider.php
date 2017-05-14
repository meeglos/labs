<?php

namespace App\Providers;

use App\Channel;
use Cache;
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
        \View::composer('tasks.create', function ($view) {
            $view->with('channels', Channel::pluck('name', 'id')->toArray());
        });

        \View::composer('*', function ($view) {
            $chaannels = Cache::rememberForever('chaannels', function () {
                return Channel::all();
            });

            $view->with('chaannels',$chaannels);
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
