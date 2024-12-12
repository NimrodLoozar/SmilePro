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
                        {{-- <h4 class="text-xl font-semibold mt-4">Adres</h4>
                        <p>{{ Auth::user()->address }}</p>
                        <h4 class="text-xl font-semibold mt-4">Telefoon</h4>
                        <p>{{ Auth::user()->phone }}</p> --}}
                    </div>
                </div>

                <!-- Statistieken -->
                <div class="w-full lg:w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">Statistieken</h3>
                        <p>Totaal aantal patiënten: <span id="totalPatients"></span></p>
                        <p>Gemiddelde wachttijd: <span id="averageWaitTime"></span> minuten</p>
                        <p>Aantal geplande afspraken: <span id="totalAppointments"></span></p>
                        <p>Aantal betalingen: <span id="totalPayments"></span></p>
                        <p>Gemiddelde afspraakduur: <span id="averageAppointmentDuration"></span> minuten</p>
                        <div id="error" class="text-red-500 mt-4" style="display: none;">Statistieken konden niet worden geladen. Probeer het later opnieuw.</div>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route('statistics.index') }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalPatients').textContent = data.total_patients;
                    document.getElementById('averageWaitTime').textContent = data.average_wait_time;
                    document.getElementById('totalAppointments').textContent = data.total_appointments;
                    document.getElementById('totalPayments').textContent = data.total_payments;
                    document.getElementById('averageAppointmentDuration').textContent = data.average_appointment_duration;
                })
                .catch(error => {
                    document.getElementById('error').style.display = 'block';
                });
        });
    </script>
</x-app-layout>
