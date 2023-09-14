<?php

namespace App\Observers;

use App\SystemRollNumber;

class SystemRollNumberObserver
{
    /**
     * Handle the system roll number "created" event.
     *
     * @param  \App\SystemRollNumber  $systemRollNumber
     * @return void
     */
    public function created(SystemRollNumber $systemRollNumber)
    {

    }

    /**
     * Handle the system roll number "updated" event.
     *
     * @param  \App\SystemRollNumber  $systemRollNumber
     * @return void
     */
    public function updated(SystemRollNumber $systemRollNumber)
    {
        if ($systemRollNumber->isDirty('organization_campus_id')) {

        }
        if ($systemRollNumber->isDirty('affiliated_body_id')) {

        }
        if ($systemRollNumber->isDirty('session_id')) {

        }
        if ($systemRollNumber->isDirty('course_id')) {

        }
        if ($systemRollNumber->isDirty('shift_id')) {

        }
    }

    /**
     * Handle the system roll number "deleted" event.
     *
     * @param  \App\SystemRollNumber  $systemRollNumber
     * @return void
     */
    public function deleted(SystemRollNumber $systemRollNumber)
    {
        //
    }

    /**
     * Handle the system roll number "restored" event.
     *
     * @param  \App\SystemRollNumber  $systemRollNumber
     * @return void
     */
    public function restored(SystemRollNumber $systemRollNumber)
    {
        //
    }

    /**
     * Handle the system roll number "force deleted" event.
     *
     * @param  \App\SystemRollNumber  $systemRollNumber
     * @return void
     */
    public function forceDeleted(SystemRollNumber $systemRollNumber)
    {
        //
    }
}
