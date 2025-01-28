<x-app-layout>
    <div class="container mx-auto p-4 dark:bg-gray-800 dark:text-white">
        <h1 class="text-3xl font-bold mb-4">Afspraak Details</h1>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg dark:bg-gray-900">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    Afspraak: {{ $appointment->name }}
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0 dark:border-gray-700">
                <dl class="sm:divide-y sm:divide-gray-200 dark:divide-gray-700">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Patiënt Naam</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->patient->person->name }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Medewerker Naam</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->employee->person->name }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Naam</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->name }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Datum</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tijd</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->time }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->status }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Actief</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->is_active ? 'Ja' : 'Nee' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Opmerking</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-300 sm:mt-0 sm:col-span-2">
                            {{ $appointment->comment }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <!-- Linkerkant knoppen -->
            <div class="flex space-x-2">
                <a href="{{ route('appointments.edit', $appointment->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Bewerken</a>
                <a href="{{ route('appointments.change-date', $appointment->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Verzetten</a>
            </div>
            
            <!-- Rechterkant knop -->
            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?')">Verwijderen</button>
            </form>
        </div>
    </div>
</x-app-layout>