<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    // Display a listing of the resource. view
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedules.index', compact('schedules'));
    }

    // Show the form for creating a new resource. create
    public function create()
    {
        return view('schedules.create');
    }

    // Store a newly created resource in storage. store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    // Display the specified resource. show
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return view('schedules.show', compact('schedule'));
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
            'name' => 'required',
            'description' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $schedule = Schedule::find($id);
        $schedule->update($request->all());

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
