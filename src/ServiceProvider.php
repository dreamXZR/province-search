<?php

namespace Dreamxzr\ProvinceSearch;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(ProvinceSearch::class,function($app){
            return new ProvinceSearch();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations')
        ], 'migrations');
    }

}