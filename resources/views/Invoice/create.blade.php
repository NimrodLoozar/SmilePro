<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Factuur Aanmaken') }}
        </h2>
        <div class="flex items-center">
            <label class="flex items-center mr-4">
                <span class="mr-2 text-gray-200">Toon Data</span>
                <div class="relative inline-block w-10 align-middle select-none transition duration-200 ease-in">
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

                    <!-- factuurnummer -->
                    <input type="hidden" name="number" id="number">
                                        
                    <!-- patient naam -->
                    <div>
                        <label for="patient" class="block text-gray-700 text-sm font-bold mb-2">Patiënt:</label>
                        <select name="patient" id="patient" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>

                    </div>

                    <!-- datum van behandeling -->
                    <div>
                        <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Datum van behandeling:</label>
                        <input type="date" name="date" id="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('date')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror

                    </div>
                    
                     <!-- Behandeling met kosten -->
                    <div class="flex flex-wrap gap-4">
                        <div class="w-full sm:w-1/2">
                            <label for="treatment_id" class="block text-gray-700 text-sm font-bold mb-2">Behandeling:</label>
                            <select name="treatment_id" id="treatment_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                @foreach ($treatments as $treatment)
                                    <option value="{{ $treatment->id }}" data-price="{{ $treatment->price }}" 
                                        {{ old('treatment_id') == $treatment->id ? 'selected' : '' }}>
                                        {{ $treatment->treatment_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Bedrag: €</label>
                            <input type="number" name="amount" id="amount"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                readonly required>
                        </div>
                    </div>
                    

                    <!-- status -->
                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <select name="status" id="status" aria-label="Selecteer de status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"                        >
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

<div id="errorContainer" class="py-8 hidden ml-32">
    <p class="text-red-500">
        De factuur kan niet worden gegenereerd. Controleer de gegevens of probeer het opnieuw.
    </p>
</div>

</x-app-layout>


<script>
   // Toggle visibility of data container
   document.getElementById('dataToggle').addEventListener('change', function () {
        const dataContainer = document.getElementById('dataContainer');
        const errorContainer = document.getElementById('errorContainer');
        dataContainer.classList.toggle('hidden', !this.checked);
        errorContainer.classList.toggle('hidden', this.checked);
    });

      // Zorg ervoor dat het script wordt uitgevoerd zodra de pagina geladen is
    document.addEventListener('DOMContentLoaded', function() {
        const treatmentSelect = document.getElementById('treatment_id');
        const amountInput = document.getElementById('amount');

        // Functie om het bedrag bij te werken
        const updateAmount = () => {
            const selectedOption = treatmentSelect.options[treatmentSelect.selectedIndex];
            const price = selectedOption.dataset.price;
            amountInput.value = price ? price : '';
        };

        // Event listener voor verandering van selectie
        treatmentSelect.addEventListener('change', updateAmount);

        // Initialiseer bedrag bij laden van de pagina
        updateAmount();
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