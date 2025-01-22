<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Patiënten') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Naam</th>
                    <th class="px-6 py-3">Nummer</th>
                    <th class="px-6 py-3">Medisch Dossier</th>
                    <th class="px-6 py-3">Actief</th>
                    <th class="px-6 py-3">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $patient->name }}</td>
                        <td class="px-6 py-4">{{ $patient->number }}</td>
                        <td class="px-6 py-4">{{ $patient->medical_file }}</td>
                        <td class="px-6 py-4">{{ $patient->is_active ? 'Actief' : 'Inactief' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('patient.edit', $patient->id) }}" class="text-blue-600 hover:underline">Bewerken</a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze patiënt wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pt-3">
            {{ $patients->links() }}
        </div>
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

    .toggle-checkbox:checked + .toggle-label {
        background-color: #68D391;
    }
</style>
