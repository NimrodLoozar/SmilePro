<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patient.index', compact('patients'));
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|string',
            'medical_file' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Patient::create($request->all());
        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol aangemaakt.');
    }

    public function edit(Request $request, Patient $patient)
    {
        $patient = Patient::getPatient($patient->id);
        dd($patient);
        
         return view('patient.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|string',
            'medical_file' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $patient->update($request->all());
        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol bijgewerkt!');
    }

    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return redirect()->route('patient.index')->with('success', 'Patiënt succesvol verwijderd.');
        } catch (\Exception $e) {
            // Log de fout
            \Log::error('Fout bij verwijderen patiënt: ' . $e->getMessage());

            // Redirect met foutmelding
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de patiënt.');
        }
    }
}