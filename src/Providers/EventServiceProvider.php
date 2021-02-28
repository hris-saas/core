<?php

namespace HRis\Core\Providers;

use HRis\Core\Observers\StatusObserver;
use Tenancy\Affects\URLs\Events\ConfigureURL;
use HRis\Core\Listeners\ConfigureApplicationUrl;
use HRis\Core\Listeners\ConfigureTenantDatabase;
use HRis\Core\Listeners\ResolveTenantConnection;
use HRis\Core\Listeners\ConfigureTenantConnection;
use HRis\Core\Listeners\ConfigureTenantMigrations;
use Tenancy\Affects\Configs\Events\ConfigureConfig;
use HRis\Core\Listeners\ConfigureTenantIntegrations;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;
use Tenancy\Affects\Connections\Events\Resolving as ResolvingConnection;
use Tenancy\Hooks\Database\Events\Drivers\Configuring as ConfiguringDatabase;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Tenancy\Affects\Connections\Events\Drivers\Configuring as ConfiguringConnection;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ConfigureMigrations::class => [
            ConfigureTenantMigrations::class,
        ],

        ConfiguringConnection::class => [
            ConfigureTenantConnection::class,
        ],

        ConfiguringDatabase::class => [
            ConfigureTenantDatabase::class,
        ],

        ResolvingConnection::class => [
            ResolveTenantConnection::class,
        ],

        ConfigureConfig::class => [
            ConfigureTenantIntegrations::class,
        ],

        ConfigureURL::class => [
            ConfigureApplicationUrl::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $statuses = config('hris-saas.models.statuses', []);

        foreach ($statuses as $model) {
            (new $model)::observe(StatusObserver::class);
        }
    }
}
