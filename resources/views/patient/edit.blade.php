@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Patiënt Bewerken</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Bewerken formulier -->
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
    </form>

    <!-- Verwijder patiënt formulier -->
    <form method="POST" action="{{ route('patient.destroy', $patient->id) }}" onsubmit="return confirm('Weet je zeker dat je dit patiëntaccount wilt verwijderen?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Verwijderen</button>
    </form>
</div>
@endsection
