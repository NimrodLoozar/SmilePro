<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Nieuwe Patiënt Toevoegen') }}
            </h2>
            <label class="flex items-center">
                <span class="mr-2 text-white">Toon Data</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" id="dataToggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        checked />
                    <div
                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" id="dataToggle"
                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                            checked />
                        <label for="dataToggle"
                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                </div>
            </label>
        </div>
    </x-slot>

    <div id="dataContainer"
        class="container mx-auto mt-8 bg-white p-6 rounded-lg shadow mb-6 dark:bg-gray-800 dark:text-white dark:border-gray-700 dark:shadow-md dark:bg-opacity-70"
        style="width: 50%;">
        <form action="{{ route('patient.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-black dark:text-white">Naam:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black"
                    type="text" id="name" name="name" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-black dark:text-white">E-mailadres:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black"
                    type="email" id="email" name="email" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-black dark:text-white">Wachtwoord:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black"
                    type="password" id="password" name="password" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-black dark:text-white">Bevestig Wachtwoord:</label>
                <input class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black"
                    type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-4">
                <label for="medical_file" class="block text-black dark:text-white">Medisch Dossier:</label>
                <textarea class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black" id="medical_file"
                    name="medical_file"></textarea>
            </div>
            <div class="mb-4">
                <label for="comment" class="block text-black dark:text-white">Opmerking:</label>
                <textarea class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black" id="comment"
                    name="comment"></textarea>
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
    <div id="errorContainer" class="container mx-auto mt-8 hidden">
        <p class="text-red-500">Er kan geen data opgehaald worden.</p>
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
