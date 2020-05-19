<?php

namespace HRis\Core\Providers;

use Illuminate\Support\Facades\Event;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}