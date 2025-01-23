<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\Invoice;

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
        // Lijst van behandelingen met bijbehorende kostenbereiken
        $treatmentTypes = [
            'Controle' => [30, 75],
            'Wortelkanaalbehandeling' => [200, 700],
            'Vulling' => [50, 150],
            'Kroon' => [300, 900],
            'Brug' => [500, 1500],
            'Tanden bleken' => [150, 500],
            'Tandsteen verwijderen' => [50, 150],
            'Extractie' => [50, 150],
            'Implantaat' => [800, 2500],
            'Beugel' => [1500, 5000],
            'Gebitsreiniging' => [50, 150],
            'Fluoridebehandeling' => [20, 50],
            'Röntgenfoto' => [30, 100],
            'Prothese' => [300, 1500],
            'Tandvleesbehandeling' => [100, 300]
        ];

        // Kies een willekeurige behandeling uit de lijst en verkrijg het bijbehorende kostenbereik
        $treatmentType = $this->faker->randomElement(array_keys($treatmentTypes));
        $amountRange = $treatmentTypes[$treatmentType];

        // Maak de behandeling aan zonder het type te gebruiken en koppel de prijs aan de factuur
        $treatment = Treatment::factory()->create();  // Treatment wordt aangemaakt zonder extra 'type' kolom

        return [
            'patient_id' => Patient::factory(),
            'treatment_id' => $treatment->id,
            'number' => self::$invoiceNumber++,
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'amount' => $this->faker->randomFloat(2, $amountRange[0], $amountRange[1]),
            'status' => $this->faker->randomElement(['betaald', 'onbetaald', 'in behandeling']),
        ];
    }
}

