<?php

namespace HRis\Core\Console\Migrations;

use HRis\Core\Traits\MutatesMigrationCommand;
use Illuminate\Database\Console\Migrations\FreshCommand as BaseCommand;

class FreshCommand extends BaseCommand
{
    use MutatesMigrationCommand;
}
