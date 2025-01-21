<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\Invoice;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $invoiceNumber = 1;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'treatment_id' => Treatment::factory(),
            'number' => self::$invoiceNumber++,
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'amount' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['betaald', 'onbetaald', 'in behandeling']),
        ];
    }
}
