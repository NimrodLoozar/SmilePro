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

        // Start from tomorrow at 00:00:00
        $startDate = Carbon::tomorrow();
        $endDate = Carbon::now()->addYear();

        // Get a random future date
        $appointmentDate = $this->faker->dateTimeBetween($startDate, $endDate);
        
        // Convert to Carbon instance for easier manipulation
        $appointmentCarbon = Carbon::instance($appointmentDate);
        
        // Generate time between 08:00 and 17:45 in 15-minute increments
        $minutes = [0, 15, 30, 45];
        $hour = $this->faker->numberBetween(8, 17);
        $minute = $this->faker->randomElement($minutes);
        
        // Set the time on our appointment date
        $appointmentCarbon->setHour($hour)->setMinute($minute)->setSecond(0);
        
        // Ensure we're not creating a past appointment due to the time
        if ($appointmentCarbon->isPast()) {
            $appointmentCarbon = Carbon::tomorrow()
                ->setHour($hour)
                ->setMinute($minute)
                ->setSecond(0);
        }

        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'date' => $appointmentCarbon->format('Y-m-d'), // Using full year format
            'time' => $appointmentCarbon->format('H:i'),
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'is_active' => $this->faker->boolean(),
            'comment' => $this->faker->optional()->sentence(),
            'name' => $this->faker->randomElement($appointmentTypes),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}