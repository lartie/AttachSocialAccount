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
        $this->publishes([
            __DIR__ . '/migrations' => base_path('/database/migrations'),
        ]);

        $this->registerBladeExtensions();
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

    /**
     * Register Blade extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('providerExists', function ($expression) {
            return "<?php if (Artie\\SocialAccounts\\Core\\Models\\SocialNetworks::providerExists{$expression}): ?>";
        });

        $blade->directive('providerNotExists', function ($expression) {
            return "<?php if (!Artie\\SocialAccounts\\Core\\Models\\SocialNetworks::providerExists{$expression}): ?>";
        });

        $blade->directive('endCheckProvider', function () {
            return "<?php endif; ?>";
        });
    }
}
