@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Patiëntenbeheer</h1>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">Nieuwe patiënt toevoegen</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Geboortedatum</th>
                <th>Contactnummer</th>
                <th>Adres</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->naam }}</td>
                    <td>{{ $patient->geboortedatum }}</td>
                    <td>{{ $patient->contactnummer }}</td>
                    <td>{{ $patient->adres }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Geen patiënten gevonden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
