<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Schedule') }}
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
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between mt-4">
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('schedules.edit', $schedule->id) }}"
                            class="text-yellow-500 hover:text-yellow-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 20h9M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                            </svg>
                        </a>

                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div>
                        <div>
                            <h1 class="text-2xl">Schedule</h1>
                            <h1 class="text-3xl pl-10">{{ $schedule->name }}</h1>
                        </div>
                        <div class="mt-4">
                            <h2 class="text-xl">Beschrijving</h2>
                            <p class="pl-10">{{ $schedule->description }}</p>
                        </div>
                        <div class="mt-4">
                            <h2 class="text-xl">Werk Tijd</h2>
                            <p class="pl-10">{{ $schedule->start_time }}</p>
                            <p class="pl-10">{{ $schedule->end_time }}</p>
                        </div>
                        <div class="flex justify-between mt-4">
                            <div>
                                <a href="{{ route('schedules.index') }}" type="button"
                                    class="btn btn-primary mt-4 bg-blue-500 hover:bg-blue-600 px-5 py-1 rounded-lg">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
