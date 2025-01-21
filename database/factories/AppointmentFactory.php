<?php
namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
            'Controle',
            'Wortelkanaalbehandeling',
            'Vulling',
            'Kroon',
            'Brug',
            'Tanden bleken',
            'Tandsteen verwijderen',
            'Extractie',
            'Implantaat',
            'Beugel',
            'Gebitsreiniging',
            'Fluoridebehandeling',
            'Röntgenfoto',
            'Prothese',
            'Tandvleesbehandeling'
        ];

        // Zorg dat de datum minimaal 24 uur in de toekomst ligt
        $startDate = Carbon::now()->addDay(); // Minimaal 24 uur in de toekomst
        $endDate = Carbon::now()->addYear(); // Maximaal 1 jaar in de toekomst
        $appointmentDate = $this->faker->dateTimeBetween($startDate, $endDate);

        return [
            'patient_id' => Patient::factory(), // Ensure PatientFactory exists
            'employee_id' => Employee::factory(), // Ensure EmployeeFactory exists
            'date' => $appointmentDate->format('Y-m-d'),
            'time' => $appointmentDate->format('H:i:s'),
            'status' => $this->faker->randomElement(['gepland', 'voltooid', 'geannuleerd']),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'name' => $this->faker->randomElement($appointmentTypes), // Add the name field
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
