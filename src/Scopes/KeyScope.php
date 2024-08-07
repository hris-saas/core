<?php

namespace HRis\Core\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class KeyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder $builder
     * @param  Model   $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('key', $model->getAttribute('key'));
    }
}
