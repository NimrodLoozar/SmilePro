<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = \App\Models\User::factory()->create();

        return [
            'user_id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'date_of_birth' => $this->faker->date(),
            'employee' => $this->faker->boolean(),
            'comment' => $this->faker->text(),
        ];
    }
}