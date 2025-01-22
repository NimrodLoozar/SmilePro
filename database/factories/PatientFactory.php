<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'name' => $user->name,
            'user_id' => $user->id,
            'person_id' => Person::factory(), // Zorg ervoor dat een PersonFactory bestaat
            'number' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'medical_file' => "Laatste consult: " . fake()->date() . " - Notities: " . fake()->sentence(),
        ];
    }
}
