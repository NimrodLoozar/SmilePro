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
        return redirect()->back()->with('error', 'Je kan geen patiënt toevoegen momenteel.');
    }

    private function generateUniqueNumber()
    {
        do {
            $number = rand(100000, 999999);
        } while (Patient::where('number', $number)->exists());

        return $number;
    }

    public function edit(Request $request, Patient $patient)
    {
        $patient = $patient->getPatient($patient->id);

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
        $patient->delete();
        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol verwijderd!');
    }
}
