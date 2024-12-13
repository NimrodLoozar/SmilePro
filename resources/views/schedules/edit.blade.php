<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Schedule') }}
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
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mt-4">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control bg-gray-100 border-2 w-full p-4 rounded-lg" required>{{ $schedule->description }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="start_time" class="block text-black">Starttijd:</label>
                            <input type="datetime-local" id="start_time" name="start_time"
                                class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm"
                                value="{{ $schedule->start_time }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="end_time" class="block text-black">Eindtijd:</label>
                            <input type="datetime-local" id="end_time" name="end_time"
                                class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm"
                                value="{{ $schedule->end_time }}" required>
                        </div>

                        <button type="submit"
                            class="btn btn-primary mt-4 bg-green-500 hover:bg-green-600 px-5 py-1 rounded-lg">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
