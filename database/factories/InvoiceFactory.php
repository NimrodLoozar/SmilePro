<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'treatment_id' => Treatment::factory(),
            'nummer' => $this->faker->unique()->randomNumber(5),
            'datum' => $this->faker->date(),
            'bedrag' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['Verzonden', 'Niet-Verzonden', 'Betaald', 'Onbetaald']),
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
