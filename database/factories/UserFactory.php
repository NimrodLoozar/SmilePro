<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Maak een Persoon aan
        $persoon = Person::factory()->create();

        return [
            'person_id' => $persoon->id, // Koppel de gebruiker aan een persoon
            'username' => $this->faker->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'is_signed_in' => false,
            'signed_in' => null,
            'signed_out' => null,
            'is_active' => 1,
            'comments' => $this->faker->sentence(),
            'datum_aangemaakt' => now(),
            'datum_gewijzigd' => now(),
        ];
    }

    /**
     * Indicate that the gebruiker should have an unverified email.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
