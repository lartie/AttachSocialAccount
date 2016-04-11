<?php

namespace LArtie\AttachSocialAccount;

use Illuminate\Support\ServiceProvider as SP;

class ServiceProvider extends SP
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/' => config_path('/')], 'config');
        $this->publishes([__DIR__ . '/database/' => base_path("database")], 'database');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
