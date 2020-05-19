<?php

namespace HRis\Core\Listeners;

use Illuminate\Support\Str;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;

class ConfigureTenantMigrations
{
    protected $order = [
        'core', 'auth', 'pim', 'ats',
    ];

    protected $finalPaths = [];

    public function handle(ConfigureMigrations $event)
    {
        $paths = app('migrator')->paths();

        foreach ($paths as $path) {
            $path .= DIRECTORY_SEPARATOR . 'tenant';

            $order = array_flip($this->order);

            foreach ($order as $key => $value) {
                if (Str::contains($path, $key)) {
                    $this->finalPaths[$value] = realpath($path);
                }
            }
        }

        ksort($this->finalPaths);

        foreach ($this->finalPaths as $path) {
            $event->path($path);
        }
    }
}
