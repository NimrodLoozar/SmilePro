<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $userName = User::find($user->id)->name;
        return [
            'name' => in_array(User::find($user->id)->role, ['patient']) ? $userName : 'Default Name',
            'user_id' => $user->id,
            'person_id' => Person::factory(), // Zorg ervoor dat een PersonFactory bestaat
            'number' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'medical_file' => $this->faker->optional()->text(200), // Optionele medische gegevens
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
