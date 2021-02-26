<?php

namespace HRis\Core\Console\Migrations;

use HRis\Core\Traits\MutatesMigrationCommand;
use Illuminate\Database\Console\Migrations\StatusCommand as BaseCommand;

class StatusCommand extends BaseCommand
{
    use MutatesMigrationCommand;
}
