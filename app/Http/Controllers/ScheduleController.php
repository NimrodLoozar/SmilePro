<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;

class ScheduleController extends Controller
{
    // Display a listing of the resource. view
    public function index()
    {
        $users = User::with('schedules')->has('schedules')->get();
        return view('schedules.index', compact('users'));
    }

    // Show the form for creating a new resource. create
    public function create()
    {
        $roles = User::whereIn('role', ['admin', 'dentist', 'employee'])
            ->get()
            ->groupBy('role');
        return view('schedules.create', compact('roles'));
    }

    // Store a newly created resource in storage. store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $user = User::find($request->user_id);
        $schedule = new Schedule($request->all());
        $schedule->name = $user->name;
        $schedule->save();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    // Display the specified resource. show
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return view('schedules.show', ['schedule' => $schedule]);
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
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        $schedule = Schedule::find($id);
        $schedule->update($request->only(['description', 'start_time', 'end_time']));

        return redirect()->route('schedules.index')
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
