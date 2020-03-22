<?php

namespace HRServices\Core\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class ClassScope implements Scope
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
        $builder->where('class', get_class($model));
    }
}
