<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Schedule;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = Carbon::now()->addDays(rand(1, 30));
        $endTime = (clone $startTime)->addDays(rand(1, 30));

        return [
            'user_id' => User::factory(),
            'name' => 
            $this->faker->randomElement(['Tandarts: Dr. Beren', 'Mondhygiënist: Dr. Astra', 'Assistent: Dr. Jansen', 'Tandarts: Dr. Jansen']),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'description' => $this->faker->paragraph,
        ];
    }
}
