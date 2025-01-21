<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Factuur') }}
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
                <!-- lijst van facturen -->
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
                        @if ($invoices->count() > 0)
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Factuurnummer</th>
                                        <th class="py-3 px-6 text-left">Datum</th>
                                        <th class="py-3 px-6 text-center">Bedrag</th>
                                        <th class="py-3 px-6 text-center">Status</th>
                                        <th class="py-3 px-6 text-center">Acties</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($invoices as $invoice)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap"># {{ $invoice->number }}</td>
                                            <td class="py-3 px-6 text-left">{{ $invoice->date }}</td>
                                            <td class="py-3 px-6 text-center">€ {{ $invoice->amount }}</td>
                                            <td class="py-3 px-6 text-center">
                                                @if($invoice->status == 'in behandeling')
                                                    <span class="bg-yellow-500 text-white py-1 px-3 rounded-full">in behandeling</span>
                                                @elseif($invoice->status == 'betaald')
                                                    <span class="bg-green-500 text-white py-1 px-3 rounded-full">betaald</span>
                                                @elseif($invoice->status == 'onbetaald')
                                                    <span class="bg-red-500 text-white py-1 px-3 rounded-full">onbetaald</span>
                                                @else
                                                    <span class="bg-gray-500 text-white py-1 px-3 rounded-full">{{ $invoice->status }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <a href="{{ route('invoice.show', $invoice->id) }}" class="text-blue-500 hover:text-blue-700">Bekijk</a> | 
                                                <a href="{{ route('invoice.edit', $invoice->id) }}" class="text-yellow-500 hover:text-yellow-700">Bewerk</a> | 
                                                <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je deze factuur wilt verwijderen?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">Verwijder</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <tbody class="text-gray-600 text-sm font-light">
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="bg-red-500 text-white p-4 rounded mb-4" colspan="5">Geen facturen gevonden. Probeer later opnieuw.</td>
                                </tr>
                            </tbody>
                        @endif
                    </div>
                </div>
                <!-- Einde lijst van facturen -->
            </div>
            <div class="py-4">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
