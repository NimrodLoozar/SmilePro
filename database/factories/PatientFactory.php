<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'person_id' => Person::factory(),
            'nummer' => $this->faker->unique()->randomNumber(5),
            'medisch_dossier' => $this->faker->paragraph,
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
