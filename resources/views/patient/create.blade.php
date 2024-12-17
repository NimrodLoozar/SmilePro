<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Nieuwe Patiënt Toevoegen') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 bg-white p-6 rounded-lg shadow mb-6 dark:bg-gray-800 dark:text-white dark:border-gray-700 dark:shadow-md dark:bg-opacity-70"
        style="width: 50%;">
        <form action="{{ route('patient.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="naam" class="block text-black dark:text-white">Naam:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:text-black"
                    type="text" id="naam" name="naam" required>
            </div>
            <div class="mb-4">
                <label for="geboortedatum" class="block text-black dark:text-white">Geboortedatum:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:text-black"
                    type="date" id="geboortedatum" name="geboortedatum" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-black dark:text-white">E-mailadres:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:text-black"
                    type="email" id="email" name="email" required>
            </div>
            <div class="mb-4">
                <label for="telefoonnummer" class="block text-black dark:text-white">Telefoonnummer:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:text-black"
                    type="text" id="telefoonnummer" name="telefoonnummer">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Opslaan
            </button>
        </form>

        @if (session('success'))
            <p class="mt-4 text-green-500">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="mt-4 text-red-500">{{ session('error') }}</p>
        @endif
    </div>
</x-app-layout>
