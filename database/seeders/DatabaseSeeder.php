<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users with specific roles
        User::factory()->testUser()->create();
        User::factory()->adminUser()->create();
        User::factory()->dentistUser()->create();
        User::factory()->employeeUser()->create();
        User::factory()->patientUser()->create();
        Schedule::factory(10)->create();

        // Other seeders can be called here
        // $this->call(OtherSeeder::class);
    }
}
