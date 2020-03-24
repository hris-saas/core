<?php

namespace HRis\Core\Validators;

interface ValidatorInterface
{
    public function handle(): void;

    public function extend(): void;

    public function replacer(): void;
}
