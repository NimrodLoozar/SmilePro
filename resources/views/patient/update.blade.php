{{-- Edit Patienten --}}
<x-app-layout>
    <h1>Patiënt Bewerken</h1>
    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="{{ $patient->person->name }}" required>
        <br>
        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="geboortedatum" value="{{ $patient->person->date_of_birth }}"
            required>
        <br>
        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" value="{{ $patient->person->email }}" required>
        <br>
        <label for="telefoonnummer">Telefoonnummer:</label>
        <input type="text" id="telefoonnummer" name="telefoonnummer" value="{{ $patient->person->phone_number }}">
        <br>
        <button type="submit">Opslaan</button>
    </form>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
</x-app-layout>
