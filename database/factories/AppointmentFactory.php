<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'datum' => $this->faker->date(),
            'tijd' => $this->faker->time(),
            'status' => $this->faker->randomElement(['Bevestigd', 'Geannuleerd']),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
