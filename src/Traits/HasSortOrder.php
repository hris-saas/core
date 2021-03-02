<?php

namespace HRis\Core\Traits;

use Illuminate\Support\Arr;

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

    /**
     * Update the sort order of other records in the database when updating a record.
     *
     * @param $record
     */
    public static function updateSortOrder($record)
    {
        // check if sort_order is in dirty array
        if (array_key_exists('sort_order', $record->getDirty())) {
            $model = get_class($record);

            // update the other records without events so it won't repeat the call
            (new $model)::withoutEvents(function () use ($record, $model) {
                $newSortOrder = $record->sort_order;
                $oldSortOrder = Arr::get($record->getOriginal(), 'sort_order');
                $sortOrders = Arr::sort([$newSortOrder, $oldSortOrder]);

                // query affected records in the model
                $query = (new $model)::whereBetween('sort_order', $sortOrders)->where('id', '!=', $record->id);

                ($newSortOrder == head($sortOrders))
                    ? $query->orderBy('sort_order')->increment('sort_order')
                    : $query->orderByDesc('sort_order')->decrement('sort_order');
            });
        }
    }

    /**
     * Update the sort order of other records in the database when deleting a record.
     *
     * @param $record
     */
    public static function deleteSortOrder($record)
    {
        $model = get_class($record);

        (new $model)::withoutEvents(function () use ($record, $model) {
            (new $model)::where('sort_order', '>', $record->sort_order)->orderBy('sort_order')->decrement('sort_order');
        });
    }

    /**
     * Update the sort order of other records in the database when restoring a record.
     *
     * @param $record
     */
    public static function restoreSortOrder($record)
    {
        $model = get_class($record);

        (new $model)::withoutEvents(function () use ($record, $model) {
            $response = (new $model)::where('sort_order', '>=', $record->sort_order)->orderBy('sort_order')->increment('sort_order');

            if (! $response) {
                $record->update(['sort_order' => (new $model)::count() + 1]);
            }
        });
    }
}
