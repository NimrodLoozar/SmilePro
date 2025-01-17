<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Employee;

class ScheduleController extends Controller
{
    // Display a listing of the resource. view
    public function index()
    {
        $users = User::with(['schedules' => function ($query) {
            $query->orderBy('start_time');
        }])->has('schedules')->paginate(10);

        if ($users->isEmpty()) {
            return view('schedules.index', compact('users'))
                ->withErrors(['no_schedules' => 'Er zijn geen schedules gevonden momenteel. Probeer later opnieuw.']);
        }

        return view('schedules.index', compact('users'));
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
            'description' => 'required',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time|after:' . now()->addHours(4),
        ]);

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
