<?php

namespace HRis\Core\Observers;

class StatusObserver extends BaseObserver
{
    /**
     * Handle the EmployeeField "created" event.
     *
     * @param  $record
     *
     * @return void
     */
    public function created($record)
    {
        //
    }

    /**
     * Handle the EmployeeField "updating" event.
     *
     * @param  $record
     *
     * @return void
     */
    public function updating($record)
    {
        parent::updating($record);
    }

    /**
     * Handle the EmployeeField "updated" event.
     *
     * @param  $record
     *
     * @return void
     */
    public function updated($record)
    {
        //
    }

    /**
     * Handle the EmployeeField "deleting" event.
     *
     * @param  $record
     *
     * @return void
     */
    public function deleting($record)
    {
        parent::deleting($record);
    }

    /**
     * Handle the EmployeeField "deleted" event.
     *
     * @param  $record
     *
     * @return void
     */
    public function deleted($record)
    {
        //
    }

    /**
     * Handle the EmployeeField "forceDeleted" event.
     *
     * @param  $record
     *
     * @return void
     */
    public function forceDeleted($record)
    {
        //
    }
}
