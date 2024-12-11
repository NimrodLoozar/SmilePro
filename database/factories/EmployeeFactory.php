<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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
            'number' => $this->faker->unique()->randomNumber(8),
            'email' => $user->email,
            'employee_type' => $this->faker->word,
            'specialization' => $this->faker->word,
            'availability' => $this->faker->text,
            'employee' => true,
            'date_of_birth' => $person->date_of_birth,
            'is_active' => true,
            'comment' => $this->faker->text,
        ];
    }
}