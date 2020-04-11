<?php

namespace HRis\Core\Traits;

trait HasSortOrder
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootHasSortOrder(): void
    {
        static::created(function ($model) {
            $model->update(['sort_order' => $model->count()]);
        });
    }
}
