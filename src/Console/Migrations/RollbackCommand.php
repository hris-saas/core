<?php

namespace HRis\Core\Console\Migrations;

use HRis\Core\Traits\MutatesMigrationCommand;
use Illuminate\Database\Console\Migrations\RollbackCommand as BaseCommand;

class RollbackCommand extends BaseCommand
{
    use MutatesMigrationCommand;
}
