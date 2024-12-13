<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Gebruikersgegevens -->
                <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 lg:mb-0">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">Mijn Gegevens</h3>
                        <h4 class="text-xl font-semibold">Naam</h4>
                        <p>{{ Auth::user()->name }}</p>
                        <h4 class="text-xl font-semibold mt-4">Email</h4>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>                 
            </div>

            <br>
            <!-- Statistieken -->
            <div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Statistieken</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-lg font-semibold">Totaal aantal patiënten</p>
                            <p class="text-3xl">{{ $totalPatients }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-lg font-semibold">Gemiddelde wachttijd</p>
                            <p class="text-3xl">{{ $averageWaitTime }} Uren</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-lg font-semibold">Aantal geplande afspraken</p>
                            <p class="text-3xl">{{ $totalAppointments }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <p class="text-lg font-semibold">Gem. afspraakduur per maand</p>
                            <p class="text-3xl">{{ $averageAppointmentDuration }} minuten</p>
                        </div>
                    </div>
                    <div class="text-red-500 mt-4" style="display: none;">Statistieken konden niet worden geladen. Probeer het later opnieuw.</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
