<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'naam' => $this->faker->randomElement(['Admin', 'Doctor', 'Receptionist']),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
