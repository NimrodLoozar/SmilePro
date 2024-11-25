<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model should have specific test user data.
     */
    public function testUser(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'TestUser',
            'email' => 'test@gmail.com',
            'password' => Hash::make('Test1234'),
            'rule' => 'employee',
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Indicate that the model should have specific employee user data.
     */
    public function adminUser(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => 'AdminUser',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin1234'),
            'rule' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
