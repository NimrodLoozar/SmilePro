<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Treatment;
// ...other model imports...

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users with specific roles
        User::factory()->count(10)->create();
        User::factory()->testUser()->create();
        User::factory()->adminUser()->create();
        User::factory()->dentistUser()->create();
        //// User::factory()->employeeUser()->create();
        User::factory()->patientUser()->create();
        Schedule::factory()->count(10)->create();

        //// Create schedules
        //// Schedule::factory()->count(10)->create();

        // Create patients
        Patient::factory()->count(10)->create();

        //// Create roles
        //// Role::factory()->count(10)->create();

        //// Create persons
        //// Person::factory()->count(10)->create();

        //// Create employees
        //// Employee::factory()->count(10)->create();

        // Create appointments
        Appointment::factory()->count(10)->create();

        // Create Invoice
        Invoice::factory()->count(10)->create();

        // Create Treatment
        Treatment::factory()->count(10)->create();

        //// Other seeders can be called here
        //// $this->call(OtherSeeder::class);
    }
}
