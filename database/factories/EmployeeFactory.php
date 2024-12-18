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
        // $user = User::factory()->create();
        // $person = Person::factory()->create([
        //     'user_id' => $user->id,
        //     'employee' => true,
        // ]);

        return [
            'user_id' => User::factory(), // Assumes a factory exists for the User model    
            'person_id' => Person::factory(), // Assumes a factory exists for the Person model
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'number' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9]{4}'),
            'employee_type' => $this->faker->randomElement(['Assistents', 'Tandarts', 'HulpDesk']),
            'specialization' => $this->faker->optional()->jobTitle(),
            'availability' => $this->faker->optional()->text(100),
            'date_of_birth' => $this->faker->date(),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
