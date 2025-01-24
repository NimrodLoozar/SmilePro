<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-between">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Factuur Aanpassen') }}
            </h2>
            <div class="flex mt-4 sm:mt-0">
                <label class="flex">
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

    <!-- Data Container -->
    <div id="dataContainer" class="py-6 px-4 sm:px-6 lg:px-8 bg-white shadow-md rounded-md">
        <form action="{{ route('invoice.update', $invoice->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Factuurnummer -->
            <div>
                <label for="number" class="block text-sm font-medium text-gray-700">Factuurnummer</label>
                <input type="text" name="number" id="number" value="{{ old('number', $invoice->number) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    readonly>
            </div>

            <!-- Patient -->
            <div>
                <label for="patient_id" class="block text-sm font-medium text-gray-700">Patiënt</label>
                <select name="patient_id" id="patient_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}"
                            {{ old('patient_id', $invoice->patient_id) == $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Datum -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Datum</label>
                <input type="date" name="date" id="date" value="{{ old('date', $invoice->date) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('date')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Behandeling -->
            <div>
                <label for="treatment_id" class="block text-sm font-medium text-gray-700">Behandeling</label>
                <select name="treatment_id" id="treatment_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($treatments as $treatment)
                        <option value="{{ $treatment->id }}"
                            data-price="{{ $treatment->price }}"
                            {{ old('treatment_id', $invoice->treatment_id) == $treatment->id ? 'selected' : '' }}>
                            {{ $treatment->treatment_type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bedrag -->
            <div>
            <label for="amount" class="block text-sm font-medium text-gray-700">Bedrag (€)</label>
                        <input type="text" name="amount" id="amount" value="{{ old('amount', $invoice->amount) }}" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            readonly>            
            </div> 

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="betaald" {{ old('status', $invoice->status) == 'betaald' ? 'selected' : '' }}>Betaald</option>
                    <option value="onbetaald" {{ old('status', $invoice->status) == 'onbetaald' ? 'selected' : '' }}>Onbetaald</option>
                    <option value="in behandeling" {{ old('status', $invoice->status) == 'in behandeling' ? 'selected' : '' }}>In behandeling</option>
                </select>
            </div>

            <!-- Actieknoppen -->
            <div class="flex flex-wrap gap-4">
                <button type="submit"
                    class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Opslaan
                </button>
                <a href="{{ route('invoice.index') }}"
                    class="w-full sm:w-auto bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-center">
                    Annuleren
                </a>
            </div>
        </form>
    </div>

    <!-- Error Container -->
    <div id="errorContainer" class="ml-6 py-6 px-4 sm:px-6 lg:px-8 hidden">
        <p class="text-red-500">De factuur kon niet worden gewijzigd. Controleer de gegevens en probeer het opnieuw.</p>
    </div>
</x-app-layout>

<script>
    // Toggle visibility
    document.getElementById('dataToggle').addEventListener('change', function () {
        document.getElementById('dataContainer').classList.toggle('hidden', !this.checked);
        document.getElementById('errorContainer').classList.toggle('hidden', this.checked);
    });

    // Lijst van behandelingen met bijbehorende kostenbereiken
    const treatmentPrices = {
        'Controle': [30, 75],
        'Wortelkanaalbehandeling': [200, 700],
        'Vulling': [50, 150],
        'Kroon': [300, 900],
        'Brug': [500, 1500],
        'Tanden bleken': [150, 500],
        'Tandsteen verwijderen': [50, 150],
        'Extractie': [50, 150],
        'Implantaat': [800, 2500],
        'Beugel': [1500, 5000],
        'Gebitsreiniging': [50, 150],
        'Fluoridebehandeling': [20, 50],
        'Röntgenfoto': [30, 100],
        'Prothese': [300, 1500],
        'Tandvleesbehandeling': [100, 300]
    };

    document.getElementById('treatment_id').addEventListener('change', function () {
        // Haal het geselecteerde behandelingstype op
        const treatmentType = this.options[this.selectedIndex].text;

        // Zoek het bijbehorende prijsbereik
        const priceRange = treatmentPrices[treatmentType];

        if (priceRange) {
            // Kies een willekeurig bedrag binnen het bereik
            const amount = (Math.random() * (priceRange[1] - priceRange[0]) + priceRange[0]).toFixed(2);
            document.getElementById('amount').value = amount;
        } else {
            document.getElementById('amount').value = '';
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
