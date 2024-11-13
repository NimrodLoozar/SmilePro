<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'straatnaam' => $this->faker->streetName,
            'huisnummer' => $this->faker->buildingNumber,
            'toevoeging' => $this->faker->optional()->word,
            'postcode' => $this->faker->postcode,
            'plaats' => $this->faker->city,
            'mobiel' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'is_actief' => true,
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
