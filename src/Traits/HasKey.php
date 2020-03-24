<?php

namespace HRis\Core\Traits;

use HRis\Core\Scopes\KeyScope;

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
