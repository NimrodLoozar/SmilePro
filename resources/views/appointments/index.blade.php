<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Afspraken') }}
            </h2>
            <label class="flex items-center">
                <span class="mr-2 text-gray-200">Toon Data</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" id="dataToggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        checked />
                    <label for="dataToggle"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </label>
        </div>
    </x-slot>

    <div id="dataContainer" class="container mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-900 border-t-4 border-green-600 rounded-b px-4 py-3 text-green-200" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-4">Afspraken</h1>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-white">Afspraken</h1>
            <a href="{{ route('appointments.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nieuwe afspraak maken</a>
        </div>

        <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-700">
                    <th class="py-2 px-4 text-left text-gray-200">Patient</th>
                    <th class="py-2 px-4 text-left text-gray-200">Medewerker</th>
                    <th class="py-2 px-4 text-left text-gray-200">Type Afspraak</th>
                    <th class="py-2 px-4 text-left text-gray-200">Datum</th>
                    <th class="py-2 px-4 text-left text-gray-200">Tijd</th>
                    <th class="py-2 px-4 text-left text-gray-200">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-4 text-gray-300">{{ $appointment->patient->person->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $appointment->employee->person->name }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $appointment->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $appointment->time }}</td>
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

        <div class="mt-4 text-gray-300">
            {{ $appointments->links() }}
        </div>
    </div>
    <div id="errorContainer" class="container mx-auto mt-8 hidden ml-64">
        <p class="text-red-500">Op dit moment geen afspraken gevonden.</p>
    </div>
</x-app-layout>

<script>
    document.getElementById('dataToggle').addEventListener('change', function() {
        const dataContainer = document.getElementById('dataContainer');
        const errorContainer = document.getElementById('errorContainer');
        if (this.checked) {
            dataContainer.classList.remove('hidden');
            errorContainer.classList.add('hidden');
        } else {
            dataContainer.classList.add('hidden');
            errorContainer.classList.remove('hidden');
        }
    });
</script>

<style>
    .toggle-checkbox:checked {
        right: 0;
        border-color: #68D391;
    }

    .toggle-checkbox:checked+.toggle-label {
        background-color: #68D391;
    }
</style>