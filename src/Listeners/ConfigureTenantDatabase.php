<?php

namespace HRis\Core\Listeners;

use Tenancy\Hooks\Database\Events\Drivers\Configuring;

class ConfigureTenantDatabase
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle(Configuring $event)
    {
        $overrides = array_merge(['host' => '%'], $event->defaults($event->tenant));

        $event->useConnection('mysql', $overrides);
    }
}
