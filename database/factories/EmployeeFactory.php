<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'person_id' => Person::factory(),
            'nummer' => $this->faker->unique()->randomNumber(5),
            'medewerkertype' => $this->faker->randomElement(['Assistent', 'Mondhygiënist', 'Tandarts', 'Praktijkmanagement']),
            'specialisatie' => $this->faker->optional()->word,
            'beschikbaarheid' => json_encode($this->faker->words(3)),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
