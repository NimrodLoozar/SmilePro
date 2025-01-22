<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    // Toon een lijst van patiënten
    public function index()
    {
        $patients = Patient::paginate(10);
        return view('patient.index', compact('patient'));
    }

    // Toon het formulier om een nieuwe patiënt toe te voegen
    public function create()
    {
        return view('patient.create');
    }

    // Sla een nieuwe patiënt op
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'number' => 'required|string',
            'medical_file' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        Patient::create($validated);

        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol toegevoegd.');
    }

    // Toon het formulier om een patiënt te bewerken
    public function edit(Patient $patient)
    {
        return view('patient.edit', compact('patient'));
    }

    // Werk een bestaande patiënt bij
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'number' => 'required|string',
            'medical_file' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol bijgewerkt.');
    }

    // Verwijder een patiënt
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol verwijderd.');
    }
}
