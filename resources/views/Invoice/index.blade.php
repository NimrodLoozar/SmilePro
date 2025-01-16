<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sample list of invoices -->
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
                        <table class="min-w-max w-full table-auto">
                            @if ($invoices->count() > 0)
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Invoice #</th>
                                        <th class="py-3 px-6 text-left">Date</th>
                                        <th class="py-3 px-6 text-center">Amount</th>
                                        <th class="py-3 px-6 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($invoices as $invoice)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $invoice->number }}</td>
                                            <td class="py-3 px-6 text-left">{{ $invoice->date }}</td>
                                            <td class="py-3 px-6 text-center">{{ $invoice->amount }}</td>
                                            <td class="py-3 px-6 text-center">{{ $invoice->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody class="text-gray-600 text-sm font-light">
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="bg-red-500 text-white p-4 rounded mb-4" colspan="4">geen facturen gevonden. Probeer later opnieuw.</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <!-- End of sample list of invoices -->
            </div>
        </div>
    </div>
</x-app-layout>
