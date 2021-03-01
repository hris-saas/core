<?php

namespace HRis\Core\Traits;

trait HasMovingForward
{
    /**
     * @param $request
     * @param $record
     *
     * @return mixed
     */
    public static function processMovingForward($request, $record)
    {
        // If updates are for this point forward.
        if ($request->has('moving_forward') && $request->moving_forward) {
            $replicate = $record->replicate();

            (new $request->model_type)::withoutEvents(function () use ($record, $replicate) {
                $record->delete();

                $replicate->save();
            });

            $record = $replicate;
        }

        return $record;
    }
}
