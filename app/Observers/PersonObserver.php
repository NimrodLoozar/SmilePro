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
            'date_of_birth' => $person->date_of_birth,
            // 'is_active' => $person->is_active,
        ]);
    }

    /**
     * Handle the Person "updated" event.
     */
    public function updated(Person $person): void
    {
        $employee = Employee::where('person_id', $person->id)->first();
        if ($employee) {
            $employee->update([
                'person_id' => $person->id,
                'user_id' => $person->user_id,
                'name' => $person->name,
                'email' => $person->email,
                'date_of_birth' => $person->date_of_birth,
                // 'is_active' => $person->is_active,
            ]);
        }
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
