<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(): View
    {
        $patients = Patient::with('person')->paginate(10);
        return view('patient.index', ['patients' => $patients]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'person_id' => 'required|exists:people,id',
            'number' => 'required|string',
            'medical_file' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $patient = Patient::create($request->all());
        return response()->json($patient, 201);
    }

    public function show(Patient $patient)
    {
        return response()->json($patient->load('person'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'person_id' => 'required|exists:people,id',
            'number' => 'required|string',
            'medical_file' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $patient->update($request->all());
        return response()->json($patient);
    }

    public function edit() {}

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect('/patients');
    }
}
