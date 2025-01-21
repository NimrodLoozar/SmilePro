<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Treatment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'treatment_type' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'cost' => $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['gepland', 'behandeld', 'geannuleerd']),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
