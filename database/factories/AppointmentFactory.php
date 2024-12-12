<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $appointmentTypes = [
            'General Checkup',
            'Dental Cleaning',
            'Eye Examination',
            'Vaccination',
            'Physical Therapy',
            'Cardiology Consultation',
            'Orthopedic Consultation',
            'Psychological Consultation',
            'Nutrition Consultation',
            'Dermatology Consultation',
        ];

        return [
            'patient_id' => Patient::factory(), // Ensure PatientFactory exists
            'employee_id' => Employee::factory(), // Ensure EmployeeFactory exists
            'date' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'time' => $this->faker->time('H:i:s'),
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'name' => $this->faker->randomElement($appointmentTypes), // Add the name field
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}