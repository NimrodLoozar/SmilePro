<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Factuur Aanpassen') }}
        </h2>
        <div class="flex items-center">
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
        <!-- Edit view form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            
                        <!-- factuurnnummer -->
                        <input type="hidden" name="number" id="number" value="{{ $invoice->number }}">



                        <!-- datum van behandeling -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="date" class="block text-sm font-medium text-gray-700">Datum van behandeling</label>
                            <input type="date" name="date" id="date" value="{{ old('date', $invoice->date) }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('date')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="appointmentType" class="block text-sm font-medium text-gray-700">Behandeling</label>
                            <select id="appointmentType" name="appointmentType" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="Controle" data-amount="50" {{ old('appointmentType', $invoice->appointmentType) == 'Controle' ? 'selected' : '' }}</option>
                                <!-- Andere opties hier -->
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Bedrag (€)</label>
                            <input type="number" id="amount" name="amount" value="{{ old('amount', $invoice->amount) }}" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                        </div>


                            
                            

                            <!-- status -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="in behandeling" {{ old('status', $invoice->status) == 'in behandeling' ? 'selected' : '' }}>in behandeling</option>
                                    <option value="betaald" {{ old('status', $invoice->status) == 'betaald' ? 'selected' : '' }}>betaald</option>
                                    <option value="onbetaald" {{ old('status', $invoice->status) == 'onbetaald' ? 'selected' : '' }}>onbetaald</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Opslaan
                    </button>
                    <a href="{{ route('invoice.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-400 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Annuleren
                    </a>

                    </div>
                </form>
            </div>
        </div>
        <!-- End of edit view form -->
    </div>

<div id="errorContainer" class="py-12 hidden ml-64">
    <p class="text-red-500">De factuur kon niet worden gewijzigd. Controleer de gegevens en probeer het opnieuw</p>
</div>
</x-app-layout>

<script>
    document.getElementById('dataToggle').addEventListener('change', function () {
        document.getElementById('dataContainer').classList.toggle('hidden', !this.checked);
        document.getElementById('errorContainer').classList.toggle('hidden', this.checked);
            if (this.checked) {
            dataContainer.classList.remove('hidden');
            errorContainer.classList.add('hidden');
        } else {
            dataContainer.classList.add('hidden');
            errorContainer.classList.remove('hidden');
        }
    });

    document.getElementById('appointmentType').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const amount = selectedOption.getAttribute('data-amount');
        document.getElementById('amount').value = amount ? amount.replace('.', '') : '';
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