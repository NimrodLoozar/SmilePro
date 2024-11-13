<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    public function run()
    {
        Treatment::factory()->count(25)->create();
    }
}
