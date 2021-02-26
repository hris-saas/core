<?php

namespace HRis\Core\Console\Migrations;

use HRis\Core\Traits\MutatesMigrationCommand;
use Illuminate\Database\Console\Migrations\MigrateCommand as BaseCommand;

class MigrateCommand extends BaseCommand
{
    use MutatesMigrationCommand;
}
