<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create([
            'user_id' => $user->id,
            'employee' => true,
        ]);

        return [
            'person_id' => $person->id,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'number' => $this->faker->unique()->randomNumber(8),
            'employee_type' => $this->faker->optional()->word, // Optional field
            'specialization' => $this->faker->optional()->word, // Optional field
            'availability' => $this->faker->optional()->text, // Optional field
            'date_of_birth' => $person->date_of_birth,
            'is_active' => $this->faker->boolean, // Boolean field
            'comment' => $this->faker->optional()->text, // Optional field
        ];
    }
}