<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Retrieve all appointments for Admins
            $appointments = Appointment::with('patient', 'employee')->paginate(10);
        } else {
            // Retrieve appointments for the current patient
            $appointments = Appointment::where('patient_id', $user->id)
                ->with('patient', 'employee')
                ->paginate(10);
        }

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::with('person')->get(); // Volledige modellen doorgeven
        $employees = Employee::with('person')->get(); // Volledige modellen doorgeven
        return view('appointments.create', compact('patients', 'employees'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'time' => 'required',
            'comment' => 'nullable|string|max:255',
        ]);

        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'employee_id' => $validated['employee_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'status' => 'Pending', // default waarde
            'is_active' => true,
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $patients = Patient::with('person')->get()->pluck('name', 'id');
        $employees = Employee::with('person')->get()->pluck('name', 'id');

        return view('appointments.edit', compact('appointment', 'patients', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patient,id', // Fixed table name
            'employee_id' => 'required|exists:employee,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $appointment->update($request->all());
        return redirect()->route('appointments.show', $appointment->id)->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
