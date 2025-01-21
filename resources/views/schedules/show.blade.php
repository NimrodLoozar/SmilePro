<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Schedule Calendar') }}
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
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div id="calendar"></div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('schedules.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach ($schedules as $schedule)
                        {
                            title: '{{ $user->name }}',
                            start: '{{ $schedule->start_time }}',
                            end: '{{ $schedule->end_time }}',
                            description: '{{ $schedule->description }}',
                            url: '{{ route('schedules.edit', $schedule->id) }}'
                        },
                    @endforeach
                ],
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    window.location.href = info.event.url;
                }
            });
            calendar.render();
        });
    </script>
</x-app-layout>
