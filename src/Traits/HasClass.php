<?php

namespace HRis\Core\Traits;

use HRis\Core\Scopes\ClassScope;

trait HasClass
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootHasClass(): void
    {
        static::addGlobalScope(new ClassScope());
    }
}
