<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Factuur aanmaken') }}
            </h2>
            <div class="flex items-center mt-2 sm:mt-0">
                <label class="flex items-center mr-4">
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
        </div>
    </x-slot> 

    <div id="dataContainer" class="py-12">
        <div class="py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('invoice.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="number" id="number">

                    <div>
                        <label for="patient" class="block text-gray-700 text-sm font-bold mb-2">Patiënt:</label>
                        <select name="patient" id="patient"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Datum van behandeling:</label>
                        <input type="date" name="date" id="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    
                    <div class="flex flex-wrap gap-4">
                        <div class="w-full sm:w-1/2">
                            <label for="appointmentType" class="block text-gray-700 text-sm font-bold mb-2">Behandeling:</label>
                            <select name="appointmentType" id="appointmentType"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                <option value="Controle" data-amount="50">Controle</option>
                                <option value="Wortelkanaalbehandeling" data-amount="200">Wortelkanaalbehandeling</option>
                                <option value="Vulling" data-amount="75">Vulling</option>
                                <option value="Kroon" data-amount="500">Kroon</option>
                                <option value="Brug" data-amount="700">Brug</option>
                                <option value="Tanden bleken" data-amount="150">Tanden bleken</option>
                                <option value="Tandsteen verwijderen" data-amount="100">Tandsteen verwijderen</option>
                                <option value="Extractie" data-amount="80">Extractie</option>
                                <option value="Implantaat" data-amount="1200">Implantaat</option>
                                <option value="Beugel" data-amount="1000">Beugel</option>
                                <option value="Gebitsreiniging" data-amount="60">Gebitsreiniging</option>
                                <option value="Fluoridebehandeling" data-amount="40">Fluoridebehandeling</option>
                                <option value="Röntgenfoto" data-amount="30">Röntgenfoto</option>
                                <option value="Prothese" data-amount="800">Prothese</option>
                                <option value="Tandvleesbehandeling" data-amount="90">Tandvleesbehandeling</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Bedrag:</label>
                            <input type="number" name="amount" id="amount"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required readonly>
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <select name="status" id="status"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                            <option value="in behandeling">in behandeling</option>
                            <option value="betaald">betaald</option>
                            <option value="onbetaald">onbetaald</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Aanmaken
                        </button>
                        <a href="{{ route('invoice.index') }}"
                            class="w-full sm:w-auto bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-center">
                            Annuleren
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="errorContainer" class="py-12 hidden px-4 sm:px-6 lg:px-8">
        <p class="text-red-500">De factuur kan niet worden gegenereerd. Controleer de gegevens en probeer het opnieuw.</p>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const errorContainer = document.getElementById('errorContainer');
        const errorMessage = document.getElementById('errorMessage');

        function showError(message) {
            errorMessage.textContent = message;
            errorContainer.classList.remove('hidden');
        }

        function hideError() {
            errorContainer.classList.add('hidden');
            errorMessage.textContent = '';
        }

        fetch('{{ route('invoice.latestNumber') }}')
            .then(response => {
                if (!response.ok) throw new Error('Failed to fetch the latest invoice number.');
                return response.json();
            })
            .then(data => {
                document.getElementById('number').value = data.nextNumber;
            })
            .catch(error => {
                showError('Er is een fout opgetreden bij het ophalen van het factuurnummer.');
                console.error(error);
            });

        document.getElementById('appointmentType').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const amount = selectedOption.getAttribute('data-amount');
            document.getElementById('amount').value = amount;
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            const patient = document.getElementById('patient').value;
            const date = document.getElementById('date').value;
            const amount = document.getElementById('amount').value;

            hideError();

            if (!patient || !date || !amount) {
                e.preventDefault();
                showError('Alle velden moeten worden ingevuld.');
                return;
            }

            if (amount <= 0) {
                e.preventDefault();
                showError('Het bedrag moet groter zijn dan nul.');
            }
        });

        document.getElementById('dataToggle').addEventListener('change', function () {
            const dataContainer = document.getElementById('dataContainer');
            if (this.checked) {
                dataContainer.classList.remove('hidden');
            } else {
                dataContainer.classList.add('hidden');
            }
        });
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
