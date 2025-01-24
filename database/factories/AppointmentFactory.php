<?php
namespace Database\Factories;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

        // Ensure date is at least 24 hours in the future
        $startDate = Carbon::now()->addDay(); 
        $endDate = Carbon::now()->addYear(); 
        $appointmentDate = $this->faker->dateTimeBetween($startDate, $endDate);

        // Generate time between 08:00 and 18:00 in 15-minute increments
        $minutes = [0, 15, 30, 45];
        $hour = $this->faker->numberBetween(8, 17);
        $minute = $this->faker->randomElement($minutes);
        $time = sprintf('%02d:%02d', $hour, $minute);

        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'date' => $appointmentDate->format('Y-m-d'),
            'time' => $time,
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'name' => $this->faker->randomElement($appointmentTypes),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}