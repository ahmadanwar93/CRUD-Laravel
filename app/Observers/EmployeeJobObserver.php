<?php

namespace App\Observers;

use App\Models\EmployeeJob;

class EmployeeJobObserver
{
    /**
     * Handle the EmployeeJob "created" event.
     *
     * @param  \App\Models\EmployeeJob  $employeeJob
     * @return void
     */
    public function created(EmployeeJob $employeeJob)
    {
        //
    }

    /**
     * Handle the EmployeeJob "updated" event.
     *
     * @param  \App\Models\EmployeeJob  $employeeJob
     * @return void
     */
    public function updated(EmployeeJob $employeeJob)
    {
        //
        if ($employeeJob->wasChanged()){
            // dd('The employee table has changed');
        }
    }

    /**
     * Handle the EmployeeJob "deleted" event.
     *
     * @param  \App\Models\EmployeeJob  $employeeJob
     * @return void
     */
    public function deleted(EmployeeJob $employeeJob)
    {
        //
    }

    /**
     * Handle the EmployeeJob "restored" event.
     *
     * @param  \App\Models\EmployeeJob  $employeeJob
     * @return void
     */
    public function restored(EmployeeJob $employeeJob)
    {
        //
    }

    /**
     * Handle the EmployeeJob "force deleted" event.
     *
     * @param  \App\Models\EmployeeJob  $employeeJob
     * @return void
     */
    public function forceDeleted(EmployeeJob $employeeJob)
    {
        //
    }
}
