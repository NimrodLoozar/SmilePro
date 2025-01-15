<?php

namespace Database\Factories;

use App\Models\Treatment;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    protected $model = Treatment::class;

    public function definition()
    {
        $treatmentTypes = [
            'Check-up',
            'Filling',
            'Crown',
            'Root Canal',
            'Extraction',
            'Dental Cleaning',
            'Implant',
            'Orthodontic Consultation',
            'Teeth Whitening',
            'X-ray'
        ];

        $statuses = [
            'Scheduled',
            'In Progress',
            'Completed',
            'Cancelled'
        ];

        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+2 months')->format('d-m-y'),
            'time' => $this->faker->time('H:i'),
            'treatment_type' => $this->faker->randomElement($treatmentTypes),
            'description' => $this->faker->paragraph(),
            'cost' => $this->faker->randomFloat(2, 50, 1500),
            'status' => $this->faker->randomElement($statuses),
            'is_active' => $this->faker->boolean(90), // 90% chance of being true
            'comment' => $this->faker->optional(0.7)->text(), // 70% chance of having a comment
        ];
    }
}

// In database/seeders/TreatmentSeeder.php
namespace Database\Seeders;