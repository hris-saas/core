<?php

namespace HRis\Core\Observers;

use HRis\Core\Traits\HasSortOrder;

class BaseObserver
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
        if (array_key_exists(HasSortOrder::class, $this->classUsesDeep($record))) {
            HasSortOrder::updateSortOrder($record);
        }
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
        if (array_key_exists(HasSortOrder::class, $this->classUsesDeep($record))) {
            HasSortOrder::deleteSortOrder($record);
        }
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

    /**
     * Returns all classes and traits used by $class.
     *
     * @param $class
     * @param $autoload
     *
     * @return array
     *
     * @see https://stackoverflow.com/a/46218389/667420
     */
    public function classUsesDeep($class, $autoload = true)
    {
        $traits = [];

        // Get traits of all parent classes
        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while ($class = get_parent_class($class));

        // Get traits of all parent traits
        $traitsToSearch = $traits;
        while (! empty($traitsToSearch)) {
            $newTraits = class_uses(array_pop($traitsToSearch), $autoload);
            $traits = array_merge($newTraits, $traits);
            $traitsToSearch = array_merge($newTraits, $traitsToSearch);
        };

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }

        return array_unique($traits);
    }
}
