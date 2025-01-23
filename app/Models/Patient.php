<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients'; // Zorg dat dit overeenkomt met de database
    protected $fillable = [
        'name',
        'medical_file',
        'is_active',
        'comment',
        
        public function updatePatient($data)
{
    return $this->update([
        'name' => $data['name'],
        'email' => $data['email'],
        // Voeg andere velden toe die bewerkt moeten worden
    ]);
    
    public function deletePatient()
{
    return $this->delete();
}

}

    ];
} : dit is me patientcontroller.php: <?php

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

    public function edit(Patient $patient)
    {
        return view('patient.edit', ['patient' => $patient]);
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $patient->update($request->all());
            return redirect()->route('patient.index')->with('success', 'Het account is succesvol bijgewerkt.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Het account kon niet worden gewijzigd. Probeer het later opnieuw.');
        }
    }

    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return redirect()->route('patient.index')->with('success', 'Het patiëntaccount is succesvol verwijderd.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Het patiëntaccount kon niet worden verwijderd. Probeer het later opnieuw.');
        }
    
        public function edit($id)
        {
            $patient = Patient::findOrFail($id);
            return view('patient.edit', compact('patient'));
        }
        
        public function update(Request $request, $id)
        {
            $patient = Patient::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                // Voeg andere validaties toe
            ]);
        
            $patient->updatePatient($validatedData);
            return redirect()->route('patient.index')->with('success', 'Het account is succesvol bijgewerkt.');
        }
        
        public function destroy($id)
{
    $patient = Patient::findOrFail($id);
    $patient->deletePatient();

    return redirect()->route('patient.index')->with('success', 'Het patiëntaccount is succesvol verwijderd.');
}

    
    }
}
 : dit is me edit.blade.php voor patient: @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Patiënt Bewerken</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="number">Patiëntnummer</label>
            <input type="text" id="number" name="number" class="form-control" value="{{ old('number', $patient->number) }}" required>
        </div>

        <div class="form-group">
            <label for="medical_file">Medisch Dossiernummer</label>
            <input type="text" id="medical_file" name="medical_file" class="form-control" value="{{ old('medical_file', $patient->medical_file) }}">
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select id="is_active" name="is_active" class="form-control" required>
                <option value="1" {{ old('is_active', $patient->is_active) == 1 ? 'selected' : '' }}>Actief</option>
                <option value="0" {{ old('is_active', $patient->is_active) == 0 ? 'selected' : '' }}>Inactief</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Opmerkingen</label>
            <textarea id="comment" name="comment" class="form-control">{{ old('comment', $patient->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="{{ route('patient.index') }}" class="btn btn-secondary">Annuleren</a>
         
        <form method="POST" action="{{ route('patient.update', $patient->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $patient->name }}" required>
    <input type="email" name="email" value="{{ $patient->email }}" required>
    <!-- Voeg andere velden toe -->
    <button type="submit">Opslaan</button>
</form>


        
    </form>
</div>
@endsection
<?php