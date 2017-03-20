<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ParserServiceProvider
 * @package App\Providers
 */
class ParserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('parse', '\App\Parsers\Parser'); /*function(){
            return new \App\Parsers\Parser();
        });/**/
    }

    public function provides()
    {
        return ['parse'];
    }
}
