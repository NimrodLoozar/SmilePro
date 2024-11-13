<?php

namespace Database\Factories;

use App\Models\Communication;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunicationFactory extends Factory
{
    protected $model = Communication::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'bericht' => $this->faker->paragraph,
            'verzonden_datum' => $this->faker->dateTime,
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
