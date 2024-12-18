<x-app-layout>
    <div class="container mx-auto p-4">
        @if ($errors->any())
            <div class="bg-red-100 border-t-4 border-red-600 rounded-b px-4 py-3 text-red-700" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-2xl font-bold text-white mb-4">Afspraakdatum wijzigen</h1>
        <form action="{{ route('appointments.update-date', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="date" class="block text-gray-300 font-bold mb-2">Nieuwe datum</label>
                <input type="date" name="date" id="date"
                    class="border border-gray-600 p-2 w-full bg-gray-800 text-gray-300"
                    value="{{ old('date', $appointment->date) }}" required>
            </div>

            <div class="mb-4">
                <label for="time" class="block text-gray-300 font-bold mb-2">Nieuwe tijd</label>
                <input type="time" name="time" id="time"
                    class="border border-gray-600 p-2 w-full bg-gray-800 text-gray-300"
                    value="{{ old('time', $appointment->time) }}" required>
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Wijzigen</button>
        </form>
    </div>
</x-app-layout>
