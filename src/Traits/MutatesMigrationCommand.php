<?php

namespace HRis\Core\Traits;

use Illuminate\Support\Str;

trait MutatesMigrationCommand
{
    protected array $order = [];

    protected array $finalPaths = [];

    protected $migrator;

    protected $dispatcher;

    public function __construct()
    {
        $this->order = array_unique(app('config')['hris-saas.database.migrations.order']);

        $this->migrator = app('migrator');

        $this->dispatcher = app('events');

        parent::__construct($this->migrator, $this->dispatcher);
    }

    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getMigrationPaths()
    {
        if (($this->input->hasOption('path') && $this->option('path')) || ($this->input->hasOption('tenant') && ! $this->option('tenant'))) {
            return parent::getMigrationPaths();
        }

        $paths = $this->migrator->paths();

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

        return $this->finalPaths;
    }
}
