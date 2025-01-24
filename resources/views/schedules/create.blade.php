<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Beschikbaarheid Aanmaken') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-black">Beschikbaarheid Toevoegen</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="schedule-form" action="{{ route('schedules.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="user_id" class="block text-black">Organisator:</label>
                <select id="user_id" name="user_id"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" required>
                    @foreach ($roles as $role => $users)
                        <optgroup label="{{ ucfirst($role) }}">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="employee_id" class="block text-black">Assistent:</label>
                <select id="employee_id" name="employee_id"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" required>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="description" class="block text-black">Beschrijving:</label>
                <textarea id="description" name="description"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm" placeholder="Voer een beschrijving in">{{ old('description') }}</textarea>
            </div>
            <div class="form-group mb-4">
                <label for="start_time" class="block text-black">Starttijd:</label>
                <input type="datetime-local" id="start_time" name="start_time"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm"
                    value="{{ old('start_time') }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="end_time" class="block text-black">Eindtijd:</label>
                <input type="datetime-local" id="end_time" name="end_time"
                    class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm"
                    value="{{ old('end_time') }}" required>
            </div>
            <div class="flex justify-between mt-4">
                <a href="{{ route('schedules.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
                <button type="button" id="create-button"
                    class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Create</button>
            </div>
        </form>
    </div>

    <div id="confirmation-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p>Weet je zeker dat je een nieuwe schedule wilt aanmaken?</p>
            <div class="mt-4 flex justify-center space-x-4">
                <button type="button" id="confirm-button"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ja</button>
                <button type="button" id="cancel-button"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Nee</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('create-button').addEventListener('click', function() {
            document.getElementById('confirmation-modal').classList.remove('hidden');
        });

        document.getElementById('confirm-button').addEventListener('click', function() {
            document.getElementById('schedule-form').submit();
        });

        document.getElementById('cancel-button').addEventListener('click', function() {
            document.getElementById('confirmation-modal').classList.add('hidden');
        });
    </script>
</x-app-layout>
