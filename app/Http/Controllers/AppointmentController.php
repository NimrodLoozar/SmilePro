<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $appointments = Appointment::with('patient', 'employee')->paginate(10);

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'employee_id' => 'required|exists:employee,id',
            'name' => 'required|string|max:255',
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $appointmentDate = Carbon::parse($value);
                    $now = Carbon::now();

                    if ($appointmentDate->lessThanOrEqualTo($now)) {
                        $fail('De afspraak kan niet in het verleden liggen.');
                    } elseif ($appointmentDate->lessThan($now->addDay())) {
                        $fail('De afspraak moet minimaal 24 uur in de toekomst liggen.');
                    }
                },
            ],
            'time' => 'required',
            'comment' => 'nullable|string|max:255',
        ]);

        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'employee_id' => $validated['employee_id'],
            'name' => $validated['name'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'status' => 'Pending',
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
        // Fetch patients and employees with their full names
        $patients = Patient::with('person')->get()->pluck('full_name', 'id');
        $employees = Employee::with('person')->get()->pluck('full_name', 'id');

        return view('appointments.edit', compact('appointment', 'patients', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'employee_id' => 'required|exists:employee,id',
            'name' => 'required|string|max:255',
            'date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $appointmentDate = Carbon::parse($value);
                    $now = Carbon::now();

                    if ($appointmentDate->lessThanOrEqualTo($now)) {
                        $fail('De afspraak kan niet in het verleden liggen.');
                    } elseif ($appointmentDate->lessThan($now->addDay())) {
                        $fail('De afspraak moet minimaal 24 uur in de toekomst liggen.');
                    }
                },
            ],
            'time' => 'required',
            'status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.show', $appointment->id)->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        // Combine date and time into a single DateTime object, including milliseconds
        $appointmentDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $appointment->date . ' ' . $appointment->time);
    
        if (!$appointmentDateTime) {
            return back()->with('error', 'De datum of tijd van de afspraak is ongeldig.');
        }
    
        // Get current datetime
        $now = new \DateTime(); // Gebruik direct new \DateTime() voor de huidige tijd
    
        // Calculate the difference
        $diff = $appointmentDateTime->diff($now);
    
        // Check if the appointment is less than 24 hours away
        if ($diff->days < 1 && $diff->invert === 0) {
            return back()->with('error', 'Kan afspraak niet annuleren omdat de afspraak over minder dan 24 uur plaatsvindt.');
        }
    
        // Proceed to delete the appointment
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
