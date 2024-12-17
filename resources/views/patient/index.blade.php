{{-- Patiënt Overzicht --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Patiënt Overzicht') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="flex justify-end mb-6">
            <a href="{{ route('patient.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Patiënt Toevoegen</a>
        </div>
        <ul class="list-disc pl-5 space-y-4">
            @foreach ($patients as $patient)
                <div class="mb-4 p-4 bg-white shadow rounded-lg flex justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">
                            <a href="{{ route('patient.show', $patient->id) }}"
                                class="text-black hover:underline">{{ $patient->person->name }}</a>
                        </h3>
                        <p>{{ $patient->person->email }}</p>
                        <p>{{ $patient->person->phone_number }}</p>
                    </div>
                    <div>
                        <a href="{{ route('patient.update', $patient->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bewerken</a>
                        <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Verwijderen</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </ul>
</x-app-layout>
