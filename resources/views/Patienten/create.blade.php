@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nieuwe patiënt toevoegen</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="naam" class="form-label">Naam</label>
            <input type="text" name="naam" id="naam" class="form-control" value="{{ old('naam') }}" required>
        </div>

        <div class="mb-3">
            <label for="geboortedatum" class="form-label">Geboortedatum</label>
            <input type="date" name="geboortedatum" id="geboortedatum" class="form-control" value="{{ old('geboortedatum') }}" required>
        </div>

        <div class="mb-3">
            <label for="contactnummer" class="form-label">Contactnummer</label>
            <input type="text" name="contactnummer" id="contactnummer" class="form-control" value="{{ old('contactnummer') }}" required>
        </div>

        <div class="mb-3">
            <label for="adres" class="form-label">Adres</label>
            <textarea name="adres" id="adres" class="form-control" rows="3" required>{{ old('adres') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Opslaan</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
