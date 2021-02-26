<?php

namespace HRis\Core\Console\Migrations;

use HRis\Core\Traits\MutatesMigrationCommand;
use Illuminate\Database\Console\Migrations\ResetCommand as BaseCommand;

class ResetCommand extends BaseCommand
{
    use MutatesMigrationCommand;
}
