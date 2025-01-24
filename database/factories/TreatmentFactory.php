<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Treatment;

class TreatmentFactory extends Factory
{
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

        // Dental-specific content components
        $complaints = [
            'pijn in de ondermolaren',
            'gevoeligheid bij koude dranken',
            'bloedend tandvlees tijdens poetsen',
            'gezwollen kaak',
            'kiespijn bij kauwen',
            'cosmetische afwijking fronttanden'
        ];

        $diagnoses = [
            'cariës op element #36',
            'acute parodontitis',
            'gebroken kroon',
            'peri-apicaal abces',
            'gingivarecessie',
            'tandsteenophoping'
        ];

        $procedures = [
            'wortelkanaalbehandeling met tijdelijke vulling',
            'composietrestauratie',
            'extractie onder lokale anesthesie',
            'professionele gebitsreiniging',
            'aanmeten kroon',
            'fluoride-applicatie'
        ];

        $recommendations = [
            'zachte voeding voor 24 uur',
            'mondspoeling tweemaal daags',
            'controleafspraak over 2 weken',
            'röntgenfollow-up over 6 maanden',
            'verwijzing naar kaakchirurg',
            'mondhygiëne-instructies'
        ];

        return [
            'patient_id' => Patient::factory(),
            'employee_id' => Employee::factory(),
            'treatment_type' => $this->faker->randomElement($treatmentTypes),
            'description' => "**Klacht:** Patiënt meldt " . $this->faker->randomElement($complaints) . ".\n\n" .
                             "**Diagnose:** " . $this->faker->randomElement($diagnoses) . " vastgesteld middels " .
                             $this->faker->randomElement(['klinisch onderzoek', 'röntgenopname', 'percussietest', 'koudetest']) . ".\n\n" .
                             "**Behandeling:** " . $this->faker->randomElement($procedures) . " uitgevoerd. " .
                             $this->faker->randomElement(['Geen complicaties waargenomen', 'Lichte bloeding gecontroleerd', 'Patiënt verdraagde procedure goed']) . ".\n\n" .
                             "**Advies:** " . $this->faker->randomElement($recommendations) . ". " .
                             "Medicatie: " . $this->faker->randomElement(['Ibuprofen 600mg 3x daags', 'Amoxicilline 500mg 3x daags', 'Chloorhexidine mondspoeling 2x daags']) . ".\n\n" .
                             "**Follow-up:** " . $this->faker->randomElement(['Controle over 1 week', 'Afrondende behandeling over 2 sessies', 'Telefonische evaluatie morgen']) . "."
        ];
    }
}