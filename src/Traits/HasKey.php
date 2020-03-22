<?php

namespace HRServices\Core\Traits;

use HRServices\Core\Scopes\KeyScope;

trait HasKey
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootHasKey(): void
    {
        static::addGlobalScope(new KeyScope());
    }
}
