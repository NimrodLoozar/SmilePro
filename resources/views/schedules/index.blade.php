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

        <div class="flex justify-end mb-4">
            <label for="viewToggle" class="mr-2 text-white">Kalenderweergave</label>
            <input type="checkbox" id="viewToggle" class="toggle-checkbox">
        </div>

        <div id="listView" class="view">
            <p class="text-white mb-4">Selecteer een van de onderstaande dokters om hun beschikbaarheid te bekijken:</p>
            <ul class="list-disc pl-5 space-y-4">
                @foreach ($users as $user)
                    <div class="mb-4 p-4 bg-white shadow rounded-lg">
                        <h3 class="text-lg font-semibold">
                            <a href="{{ route('schedules.show', $user->id) }}"
                                class="text-black hover:underline">{{ $user->name }}</a>
                        </h3>
                    </div>
                @endforeach
            </ul>
        </div>

        <div id="calendarView" class="view hidden">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div id="calendar"></div>
                    </div>
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
                    @foreach ($users as $user)
                        @foreach ($user->schedules as $schedule)
                            {
                                title: '{{ $user->name }} - {{ $schedule->description }}',
                                start: '{{ $schedule->start_time }}',
                                // end: '{{ $schedule->end_time }}',
                                // description: '{{ $schedule->description }}',
                                url: '{{ route('schedules.show', $user->id) }}'
                            },
                        @endforeach
                    @endforeach
                ],
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    window.location.href = info.event.url;
                }
            });

            document.getElementById('viewToggle').addEventListener('change', function() {
                document.getElementById('listView').classList.toggle('hidden');
                document.getElementById('calendarView').classList.toggle('hidden');
                if (!document.getElementById('calendarView').classList.contains('hidden')) {
                    calendar.render();
                }
            });
        });
    </script>
</x-app-layout>
