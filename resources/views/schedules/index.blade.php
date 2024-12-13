<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Beschikbaarheid Overzicht') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="flex justify-between mb-6">
            <a href="{{ route('schedules.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Beschikbaarheid
                Toevoegen</a>
        </div>
        <ul class="list-disc pl-5 space-y-4">
            @foreach ($users as $user)
                <div class="mb-4 p-4 bg-white shadow rounded-lg">
                    <h3 class="text-lg font-semibold">
                        <a href="{{ route('schedules.show', $user->schedules->first()->id) }}"
                            class="text-black hover:underline">{{ $user->name }}</a>
                    </h3>
                    <ul class="list-disc pl-5 space-y-2">
                        @foreach ($user->schedules as $schedule)
                            <li>
                                <p class="text-blue-600"><strong>Start Time:</strong> {{ $schedule->start_time }}</p>
                                <p class="text-blue-600"><strong>End Time:</strong> {{ $schedule->end_time }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </ul>
    </div>
</x-app-layout>
