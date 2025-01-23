<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\Treatment;

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
        $user = User::inRandomOrder()->first();
        $startTime = Carbon::now()->addDays(rand(1, 30))->toDateTimeString();
        $endTime = Carbon::parse($startTime)->addHours(rand(1, 8))->toDateTimeString();
        $userName = User::find($user->id)->name;

        return [
            'user_id' => $user->id,
            'employee_id' => Employee::factory(),
            'name' => in_array(User::find($user->id)->role, ['admin', 'dentist']) ? $userName : 'Default Name',
            'start_time' => $startTime,
            'end_time' => $endTime,
            'description' => $this->faker->paragraph,
            'is_active' => $this->faker->boolean,
        ];
    }
}
