<?php

namespace HRis\Core\Traits;

use Illuminate\Foundation\Console\Kernel;

trait UseCreateApplication
{
    public function createApplication()
    {
        $appPaths = $this->appPaths;

        if (getenv('CI_PROJECT_DIR')) {
            $appPaths[] = realpath(getenv('CI_PROJECT_DIR') . '/vendor/laravel/laravel');
        }
        
        $app = false;

        foreach ($appPaths as $path) {
            $boot = "$path/bootstrap/app.php";
            if (file_exists($boot)) {
                /** @var Application $app */
                $app = require $boot;

                break;
            }
        }

        if (! $app) {
            throw new \RuntimeException('No bootstrap file found, make sure laravel/laravel is installed');
        }

        $app->make(Kernel::class)->bootstrap();

        foreach ($this->loadProviders as $provider) {
            if (! $app->register($provider)) {
                throw new \RuntimeException("Failed registering $provider");
            }
        }

        $this->faker = \Faker\Factory::create();

        config($this->config);

        return $app;
    }
}
