<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Communication;

class CommunicationSeeder extends Seeder
{
    public function run()
    {
        Communication::factory()->count(30)->create();
    }
}
