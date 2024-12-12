<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Str;
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
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'employee' => $this->faker->boolean(),
            'date_of_birth' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}