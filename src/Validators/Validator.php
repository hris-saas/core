<?php

namespace HRis\Core\Validators;

class Validator
{
    private static $validators = [
        SortOrderFieldValidator::class,
        UniqueFieldValidator::class,
    ];

    public static function registerValidators(): void
    {
        foreach (self::$validators as $validator) {
            (new $validator())->handle();
        }
    }
}
