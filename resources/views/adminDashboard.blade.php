<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Gebruikersgegevens -->
                <div
                    class="w-full lg:w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 lg:mb-0">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">Mijn Gegevens</h3>
                        <h4 class="text-xl font-semibold">Naam</h4>
                        <p>{{ Auth::user()->name }}</p>
                        <h4 class="text-xl font-semibold mt-4">Email</h4>
                        <p>{{ Auth::user()->email }}</p>
                        <h4 class="text-xl font-semibold mt-4">Adres</h4>
                        <p>{{ Auth::user()->address }}</p>
                        <h4 class="text-xl font-semibold mt-4">Telefoon</h4>
                        <p>{{ Auth::user()->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
