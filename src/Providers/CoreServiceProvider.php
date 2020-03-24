<?php

namespace HRis\Core\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class CoreServiceProvider extends BaseServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }

        $this->registerTranslations();
    }

    /**
     * Register Core's translation files.
     *
     * @return void
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../assets/lang', 'core');

        $this->publishes([
            __DIR__.'/../../assets/lang' => resource_path('lang/vendor/hris-saas/core'),
        ], 'hris-saas::core-translations');
    }

    /**
     * Register Core's migration files.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../assets/migrations');

        $this->publishes([
            __DIR__.'/../../assets/migrations' => database_path('migrations'),
        ], 'hris-saas::core-migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        // TODO: Implement register() method.
    }
}
