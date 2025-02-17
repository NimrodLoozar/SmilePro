<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Patiënten') }}
            </h2>
            <label class="flex items-center">
                <span class="mr-2 text-gray-200">Show Data</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" id="dataToggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        checked />
                    <label for="dataToggle"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </label>
            <a href="{{ route('patient.create') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Nieuwe Patiënt
            </a>
        </div>
    </x-slot>

    <div id="dataContainer" class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
        @if ($patients->isEmpty())
            <p class="text-gray-500">Geen patiënten gevonden.</p>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Nummer</th>
                        <th scope="col" class="px-6 py-3">Medisch dossier</th>
                        <th scope="col" class="px-6 py-3">Actief</th>
                        <th scope="col" class="px-6 py-3">Opmerkingen</th>
                        <th scope="col" class="px-6 py-3">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $patient->person->name }}
                            </th>
                            <td class="px-6 py-4">{{ $patient->number }}</td>
                            <td class="px-6 py-4">{{ $patient->medical_file }}</td>
                            <td class="px-6 py-4">
                                @if ($patient->is_active)
                                    Actief
                                @else
                                    Inactief
                                @endif
                            </td>
                            <td class="px-6 py-4 text-wrap">{{ $patient->comment }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('patient.edit', $patient->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Bewerken</a>
                                <form id="delete-form-{{ $patient->id }}"
                                    action="{{ route('patient.destroy', $patient->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDeletion({{ $patient->id }})"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-3">

            </div>
        @endif
    </div>

    <div id="errorContainer" class="container mx-auto mt-8 hidden">
        <p class="text-red-500">Er is een probleem bij het ophalen van gegevens.</p>
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

    function confirmDeletion(patientId) {
        const confirmation = confirm('Weet je zeker dat je deze patiënt wilt verwijderen?');
        if (confirmation) {
            document.getElementById(`delete-form-${patientId}`).submit();
        }
    }
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
