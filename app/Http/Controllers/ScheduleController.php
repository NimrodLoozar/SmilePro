<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    // Display a listing of the resource. view
    public function index()
    {
        $users = User::with(['schedules' => function ($query) {
            $query->orderBy('start_time');
        }])->has('schedules')->paginate(10);

        return view('schedules.index', compact('users'));
    }

    private function isDurationExceedingLimit($startTime, $endTime, $limitInHours = 8)
    {
        return $endTime->diffInHours($startTime) > $limitInHours;
    }

    // Show the form for creating a new resource. create
    public function create()
    {
        $roles = User::whereIn('role', ['admin', 'dentist', 'Tandarts'])
            ->get()
            ->groupBy(function ($user) {
                return $user->role === 'dentist' ? 'Dentist' : $user->role;
            });
        $employees = Employee::all(); // Fetch all employees

        return view('schedules.create', compact('roles', 'employees'));
    }


    // Store a newly created resource in storage. store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:employees,id',
            'description' => 'nullable',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time|after:' . now()->addHours(4),
        ]);

        $startDate = Carbon::parse($request->start_time)->toDateString();
        $existingSchedule = Schedule::where('user_id', $request->user_id)
            ->whereDate('start_time', $startDate)
            ->exists();

        if ($existingSchedule) {
            return redirect()->back()
                ->withErrors(['user_id' => 'Deze organisator heeft al een schedule op deze dag.'])
                ->withInput();
        }

        // De tijd tussen starttijd en eindtijd mag maximaal 8 uur zijn.
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        if ($this->isDurationExceedingLimit($startTime, $endTime)) {
            return redirect()->back()
                ->withErrors(['end_time' => 'De duur tussen starttijd en eindtijd mag maximaal 8 uur zijn.'])
                ->withInput();
        }

        $user = User::find($request->user_id);
        $schedule = new Schedule($request->all());
        $schedule->name = $user->name;
        $schedule->employee_id = $request->employee_id; // Set employee_id
        $schedule->save();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    // Display the specified resource. show
    public function show($id)
    {
        $user = User::find($id);
        $schedules = $user->schedules;
        return view('schedules.show', compact('user', 'schedules'));
    }

    // Show the form for editing the specified resource. edit
    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('schedules.edit', compact('schedule'));
    }

    // Update the specified resource in storage. update
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time|after:' . now()->addHours(4),
        ]);

        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        if ($endTime->diffInHours($startTime) > 8) {
            return redirect()->back()
                ->withErrors(['end_time' => 'De duur tussen starttijd en eindtijd mag maximaal 8 uur zijn.'])
                ->withInput();
        }

        $schedule = Schedule::find($id);
        $schedule->update($request->only(['description', 'start_time', 'end_time']));

        return redirect()->route('schedules.show', $schedule->user_id)
            ->with('success', 'Schedule updated successfully.');
    }

    // Remove the specified resource from storage. delete
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
