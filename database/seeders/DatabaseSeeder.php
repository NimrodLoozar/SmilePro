<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Person;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Appointment;
use App\Models\Communication;
use App\Models\Feedback;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Treatment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Eerst de gebruikers aanmaken
        $this->call([
            UserSeeder::class,
            PersonSeeder::class,
            RoleSeeder::class,
            PatientSeeder::class,
            EmployeeSeeder::class,
            AppointmentSeeder::class,
            TreatmentSeeder::class,
            InvoiceSeeder::class,
            CommunicationSeeder::class,
            FeedbackSeeder::class,
            ContactSeeder::class,
        ]);

        // Optioneel: Je kunt handmatig wat data invoegen als dat nodig is:
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'),
        // ]);

        // Andere database-initiatieven kunnen hier worden toegevoegd.
    }
}
