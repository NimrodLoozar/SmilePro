<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Beschikbaarheid Aanmaken') }}
        </h2>
    </x-slot>


    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-black">Beschikbaarheid Toevoegen</h1>
        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="name" class="block text-black">Naam:</label>
                <input type="text" id="name" name="name"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" required>
            </div>
            <div class="form-group mb-4">
                <label for="start_time" class="block text-black">Starttijd:</label>
                <input type="datetime-local" id="start_time" name="start_time"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" required>
            </div>
            <div class="form-group mb-4">
                <label for="end_time" class="block text-black">Eindtijd:</label>
                <input type="datetime-local" id="end_time" name="end_time"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" required>
            </div>
            <div class="form-group mb-4">
                <label for="description" class="block text-black">Beschrijving:</label>
                <textarea id="description" name="description"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" required></textarea>
            </div>
            <button type="submit"
                class="btn btn-primary bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
    </div>

</x-app-layout>
