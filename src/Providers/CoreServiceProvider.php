<?php

namespace HRis\Core\Providers;

use HRis\Core\Console\Migrations\FreshCommand;
use HRis\Core\Console\Migrations\ResetCommand;
use HRis\Core\Console\Migrations\StatusCommand;
use HRis\Core\Console\Migrations\MigrateCommand;
use HRis\Core\Console\Migrations\RollbackCommand;
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
        $this->loadMigrationsFrom(__DIR__.'/../../assets/database/migrations');

        $this->publishes([
            __DIR__.'/../../assets/database/migrations' => database_path('migrations'),
        ], 'hris-saas::core-migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('command.migrate.fresh', function () {
            return new FreshCommand();
        });

        $this->app->extend('command.migrate', function () {
            return new MigrateCommand();
        });

        $this->app->extend('command.migrate.reset', function () {
            return new ResetCommand();
        });

        $this->app->extend('command.migrate.rollback', function () {
            return new RollbackCommand();
        });

        $this->app->extend('command.migrate.status', function () {
            return new StatusCommand();
        });
    }
}
