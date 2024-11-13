<?php

namespace Database\Factories;

use App\Models\Treatment;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    protected $model = Treatment::class;

    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),
            'datum' => $this->faker->date(),
            'tijd' => $this->faker->time(),
            'omschrijving' => $this->faker->sentence,
            'kosten' => $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['Behandeld', 'Onbehandeld', 'Uitgesteld']),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
