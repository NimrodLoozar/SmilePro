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
            <button type="button" id="create-button"
                class="btn btn-primary bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
        <a href="{{ route('schedules.index') }}"
            class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">
            Beschikbaarheid Overzicht
        </a>
    </div>

    <!-- Modal -->
    <div id="confirmation-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Bevestiging
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Weet je zeker dat je een nieuwe schedule wilt aanmaken?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirm-button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Ja
                    </button>
                    <button type="button" id="cancel-button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Nee
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
