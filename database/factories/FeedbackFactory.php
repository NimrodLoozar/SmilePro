<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'beoordeling' => $this->faker->numberBetween(1, 5),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
