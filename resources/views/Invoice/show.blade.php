<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        {{ __('Factuur') }} #{{ $invoice->number }}
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">Factuurnummer: #{{ $invoice->number }}</h3>
                </div>
                <div class="mb-2">
                    <p><strong>Datum:</strong> {{ $invoice->date }}</p>
                </div>
                <div class="mb-2">
                    <p><strong>Patient:</strong> {{ $patient->person->name }}</p>
                </div>
                <div class="mb-2">
                    <p><strong>Bedrag:</strong> € {{ $invoice->amount }}</p>
                </div>
               

                <!-- <div class="mb-4">
                   
                </div> -->

                

                <div class="mb-4">
                    <p><strong>Status:</strong> 
                        @if($invoice->status == 'in behandeling')
                            <span class="bg-yellow-500 text-white py-1 px-3 rounded-full">in behandeling</span>
                        @elseif($invoice->status == 'betaald')
                            <span class="bg-green-500 text-white py-1 px-3 rounded-full">betaald</span>
                        @elseif($invoice->status == 'onbetaald')
                            <span class="bg-red-500 text-white py-1 px-3 rounded-full">onbetaald</span>
                        @else
                            <span class="bg-gray-500 text-white py-1 px-3 rounded-full">{{ $invoice->status }}</span>
                        @endif
                    </p>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('invoice.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-green-700">Terug naar overzicht</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="errorContainer" class="py-12 hidden ml-64">
    <p class="text-red-500">Factuur kon niet ingeladen. Probeer het later opnieuw.</p>
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
