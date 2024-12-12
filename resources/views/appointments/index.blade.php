<x-layout>
    <div class="container mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-100 border-t-4 border-green-600 rounded-b px-4 py-3 text-green-700" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold">Afspraken</h1>
            <a href="{{ route('appointments.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nieuwe afspraak maken</a>
        </div>

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left">Patient</th>
                    <th class="py-2 px-4 text-left">Medewerker</th>
                    <th class="py-2 px-4 text-left">Type Afspraak</th> <!-- Added column for appointment type -->
                    <th class="py-2 px-4 text-left">Datum</th>
                    <th class="py-2 px-4 text-left">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border-t border-gray-300">
                        <td class="py-2 px-4">{{ $appointment->patient->full_name ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $appointment->employee->name }}</td>
                        <td class="py-2 px-4">{{ $appointment->name ?? 'N/A' }}</td> <!-- Display the appointment type -->
                        <td class="py-2 px-4">{{ $appointment->date }}</td>
                        <td class="py-2 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('appointments.show', $appointment->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bekijken</a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
</x-layout>