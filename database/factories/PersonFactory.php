<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        return [
            'voornaam' => $this->faker->firstName,
            'tussenvoegsel' => $this->faker->optional()->word,
            'achternaam' => $this->faker->lastName,
            'geboortedatum' => $this->faker->date(),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
