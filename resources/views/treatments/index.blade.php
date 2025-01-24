<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Behandelingen') }}
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

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-white">Behandelingen</h1>
            <!-- Create button removed -->
        </div>

        <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-700">
                    <th class="py-2 px-4 text-left text-gray-200">Patient</th>
                    <th class="py-2 px-4 text-left text-gray-200">Medewerker</th>
                    <th class="py-2 px-4 text-left text-gray-200">Type</th>
                    <th class="py-2 px-4 text-left text-gray-200">Omschrijving</th>
                    <th class="py-2 px-4 text-left text-gray-200">Kosten</th>
                    <th class="py-2 px-4 text-left text-gray-200">Status</th>
                    <th class="py-2 px-4 text-left text-gray-200">Actief</th>
                    <th class="py-2 px-4 text-left text-gray-200">Opmerking</th>
                    <th class="py-2 px-4 text-left text-gray-200">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($treatments as $treatment)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-4 text-gray-300">{{ $treatment->patient->name ?? $treatment->patient_id }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $treatment->employee->name ?? $treatment->employee_id }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $treatment->treatment_type }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ Str::limit($treatment->description, 30) }}</td>
                        <td class="py-2 px-4 text-gray-300">€{{ number_format($treatment->cost, 2, ',', '.') }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $treatment->status }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 text-sm rounded-full {{ $treatment->is_active ? 'bg-green-600 text-green-100' : 'bg-red-600 text-red-100' }}">
                                {{ $treatment->is_active ? 'Actief' : 'Inactief' }}
                            </span>
                        </td>
                        <td class="py-2 px-4 text-gray-300">{{ Str::limit($treatment->comment, 20) }}</td>
                        <td class="py-2 px-4">
                            <div class="flex space-x-2">
                                <!-- View button removed -->
                                <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Weet je zeker dat je deze behandeling wilt verwijderen?')">Verwijderen</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-gray-300">
            {{ $treatments->links() }}
        </div>
    </div>
    <div id="errorContainer" class="container mx-auto mt-8 hidden ml-64">
        <p class="text-red-500">Er kunnen geen behandelingen worden opgehaald.</p>
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