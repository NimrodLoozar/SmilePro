<x-layout>
    <div class="container mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-100 border-t-4 border-green-600 rounded-b px-4 py-3 text-green-700" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-4">Afspraken</h1>

        <p class="mb-4">
            <a href="{{ route('appointments.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nieuwe afspraak maken</a>
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($appointments as $appointment)
                <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                    <h2 class="text-xl font-semibold mb-2">{{ $appointment->patient->full_name ?? 'N/A' }}</h2>
                    <p class="text-gray-600"><strong>Medewerker:</strong>
                        {{ $appointment->employee->name }}</p>
                    <p class="text-gray-600"><strong>Datum:</strong> {{ $appointment->date }}</p>
                    <div class="mt-4 flex space-x-2">
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
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
</x-layout>
