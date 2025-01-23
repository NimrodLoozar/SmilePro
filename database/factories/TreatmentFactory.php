<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Treatment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $treatmentTypes = [
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
        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'treatment_type' => $this->faker->randomElement($treatmentTypes),
            'description' => $this->faker->paragraph(),
        ];
    }
}
