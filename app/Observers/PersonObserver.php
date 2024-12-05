<?php

namespace App\Observers;

use App\Models\Person;
use App\Models\Employee;

class PersonObserver
{
    /**
     * Handle the Person "created" event.
     */
    public function created(Person $person): void
    {
        Employee::create([
            'person_id' => $person->id,
            'user_id' => $person->user_id,
            'name' => $person->name,
            'email' => $person->email,
            'is_active' => $person->is_active,
        ]);
    }

    /**
     * Handle the Person "updated" event.
     */
    public function updated(Person $person): void
    {
        $person->employee->update([
            'person_id' => $person->id,
            'user_id' => $person->user_id,
            'name' => $person->name,
            'email' => $person->email,
            'is_active' => $person->is_active,
        ]);
    }

    /**
     * Handle the Person "deleted" event.
     */
    public function deleted(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "restored" event.
     */
    public function restored(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "force deleted" event.
     */
    public function forceDeleted(Person $person): void
    {
        //
    }
}
