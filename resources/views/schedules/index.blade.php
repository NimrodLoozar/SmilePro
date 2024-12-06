<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Beschikbaarheid Overzicht') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="flex justify-between mb-6">
            <a href="{{ route('schedules.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Beschikbaarheid Toevoegen</a>
        </div>
        <ul class="list-disc pl-5 space-y-4">
            @foreach ($schedules as $schedule)
                <div class="mb-4 p-4 bg-white shadow rounded-lg">
                    <a href="{{ route('schedules.show', $schedule->id) }}" class="text-black hover:underline text-lg font-semibold">{{ $schedule->name }}</a>
                    <p class="mt-2 text-blue-600"><strong>Start Time:</strong> {{ $schedule->start_time }}</p>
                    <p class="mt-2 text-blue-600"><strong>End Time:</strong> {{ $schedule->end_time }}</p>
                </div>
            @endforeach
        </ul>
    </div>
</x-app-layout>
