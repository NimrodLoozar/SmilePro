<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Factuur') }} #{{ $invoice->number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Factuurnummer: #{{ $invoice->number }}</h3>
                </div>
                <div class="mb-4">
                    <p><strong>Datum:</strong> {{ $invoice->date }}</p>
                </div>
                <div class="mb-4">
                    <p><strong>Bedrag:</strong> € {{ $invoice->amount }}</p>
                </div>
                <div class="mb-4">
                    <p><strong>Patient ID:</strong> {{ $invoice->patient_id }}</p>
                </div>
                <div class="mb-4">
                    <p><strong>Patient:</strong> {{ $patient->person->name }} </p>
                </div>

                
                <!-- pending -->
                <div class="mb-4">
                    <p><strong>Behandeling:</strong> {{ $invoice->treatment }}</p>
                </div>


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
</x-app-layout>
