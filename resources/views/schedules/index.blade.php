<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Beschikbaarheid Overzicht') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="flex flex-col lg:flex-row justify-between mb-6">
            <a href="{{ route('schedules.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 lg:mb-0">Beschikbaarheid
                Toevoegen</a>
        </div>

        @if ($errors->has('no_schedules'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ $errors->first('no_schedules') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-1 pl-4 mb-4 lg:mb-0">
                <p class="text-white mb-4">Selecteer een van de onderstaande dokters om hun beschikbaarheid te bekijken:
                </p>
                <ul class="list-disc pl-5 space-y-4 hidden lg:block">
                    @foreach ($users as $user)
                        <div class="mb-4 p-4 bg-white shadow rounded-lg">
                            <h3 class="text-lg font-semibold">
                                <a href="{{ route('schedules.show', $user->id) }}"
                                    class="text-black hover:underline">{{ $user->name }}</a>
                            </h3>
                        </div>
                    @endforeach
                </ul>
                <select class="block lg:hidden w-full border-black-300 rounded-md shadow-sm"
                    onchange="location = this.value;">
                    <option value="">{{ __('Selecteer een dokter') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ route('schedules.show', $user->id) }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div id="calendar"></div>
                        </div>
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
                    @foreach (App\Models\User::with([
        'schedules' => function ($query) {
            $query->orderBy('start_time', 'asc');
        },
    ])->get() as $user)
                        @foreach ($user->schedules as $schedule)
                            {
                                title: '{{ $user->name }} - {{ $schedule->description }}',
                                start: '{{ $schedule->start_time }}',
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

            calendar.render();
        });
    </script>
</x-app-layout>
