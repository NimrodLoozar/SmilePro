<?php

namespace App\Observers;

use App\Models\Person;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Person::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'date_of_birth' => $user->date_of_birth,
            'employee' => $user->employee,
            // 'is_active' => $user->is_active,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $user->person->update([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'date_of_birth' => $user->date_of_birth,
            'employee' => $user->employee,
            // 'is_active' => $user->is_active,
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
