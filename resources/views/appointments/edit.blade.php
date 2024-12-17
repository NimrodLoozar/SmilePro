<x-app-layout>
    <div class="container mx-auto p-4 dark:bg-gray-800 dark:text-white">
        <h1 class="text-2xl font-bold mb-4">Afspraak bewerken</h1>

        @if(session('success'))
            <div class="bg-green-100 border-t-4 border-green-600 rounded-b px-4 py-3 text-green-700" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-t-4 border-red-600 rounded-b px-4 py-3 text-red-700" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="patient_id" class="block text-gray-700 font-bold mb-2">Patient</label>
                <select name="patient_id" id="patient_id" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
                    @foreach($patients as $id => $name)
                        <option value="{{ $id }}" {{ $appointment->patient_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="employee_id" class="block text-gray-700 font-bold mb-2">Medewerker</label>
                <select name="employee_id" id="employee_id" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
                    @foreach($employees as $id => $name)
                        <option value="{{ $id }}" {{ $appointment->employee_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Naam</label>
                <input type="text" name="name" id="name" value="{{ $appointment->name }}" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-bold mb-2">Datum</label>
                <input type="date" name="date" id="date" value="{{ $appointment->date }}" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="time" class="block text-gray-700 font-bold mb-2">Tijd</label>
                <input type="time" name="time" id="time" value="{{ $appointment->time }}" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
                    <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="is_active" class="block text-gray-700 font-bold mb-2">Actief</label>
                <select name="is_active" id="is_active" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300">
                    <option value="1" {{ $appointment->is_active ? 'selected' : '' }}>Ja</option>
                    <option value="0" {{ !$appointment->is_active ? 'selected' : '' }}>Nee</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="comment" class="block text-gray-700 font-bold mb-2">Opmerking</label>
                <textarea name="comment" id="comment" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-900 dark:text-gray-300" rows="4">{{ $appointment->comment }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-600 hover:underline mr-2">Annuleren</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Opslaan</button>
            </div>
        </form>
    </div>
</x-app-layout>
