<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Patiënt Toevoegen</title>
</head>

<body>
    <h1>Nieuwe Patiënt Toevoegen</h1>
    <form action="{{ route('patiënt.store') }}" method="POST">
        @csrf
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required>
        <br>
        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="geboortedatum" required>
        <br>
        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="telefoonnummer">Telefoonnummer:</label>
        <input type="text" id="telefoonnummer" name="telefoonnummer">
        <br>
        <button type="submit">Opslaan</button>
    </form>

    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
    @endif
</body>

</html>