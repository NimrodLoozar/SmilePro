<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Beschikbaarheid wijzigen') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                            <textarea name="description" id="description" class="form-control bg-gray-100 border-2 w-full p-4 rounded-lg" required>{{ old('description', $schedule->description) }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="start_time" class="block text-black">Starttijd:</label>
                            <input type="datetime-local" id="start_time" name="start_time"
                                class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm"
                                value="{{ old('start_time', $schedule->start_time) }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="end_time" class="block text-black">Eindtijd:</label>
                            <input type="datetime-local" id="end_time" name="end_time"
                                class="form-control mt-1 block w-full border-black-300 rounded-md shadow-sm"
                                value="{{ old('end_time', $schedule->end_time) }}" required>
                        </div>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('schedules.show', $schedule->user_id) }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <div class="flex space-x-4">
                                <button type="button" onclick="showUpdateConfirmationPopup()"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Update
                                </button>
                                <button type="button" onclick="showConfirmationPopup()"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmationPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p>Weet je zeker dat je deze beschikbaarheid wilt verwijderen?</p>
            <div class="mt-4 flex justify-center space-x-4">
                <button onclick="confirmDeletion()" type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Ja</button>
                <button onclick="hideConfirmationPopup()"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Nee</button>
            </div>
        </div>
    </div>
    <div id="updateConfirmationPopup"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p>Weet je zeker dat je deze beschikbaarheid wilt updaten?</p>
            <div class="mt-4 flex justify-center space-x-4">
                <button onclick="confirmUpdate()"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ja</button>
                <button onclick="hideUpdateConfirmationPopup()"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Nee</button>
            </div>
        </div>
    </div>
    <script>
        function showConfirmationPopup() {
            document.getElementById('confirmationPopup').classList.remove('hidden');
        }

        function hideConfirmationPopup() {
            document.getElementById('confirmationPopup').classList.add('hidden');
        }

        function confirmDeletion() {
            document.getElementById('deleteForm').submit();
        }

        function showUpdateConfirmationPopup() {
            document.getElementById('updateConfirmationPopup').classList.remove('hidden');
        }

        function hideUpdateConfirmationPopup() {
            document.getElementById('updateConfirmationPopup').classList.add('hidden');
        }

        function confirmUpdate() {
            document.getElementById('hidden_description').value = document.getElementById('description').value;
            document.getElementById('hidden_start_time').value = document.getElementById('start_time').value;
            document.getElementById('hidden_end_time').value = document.getElementById('end_time').value;
            document.getElementById('updateForm').submit();
        }
    </script>
    <form id="deleteForm" action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    <form id="updateForm" action="{{ route('schedules.update', $schedule->id) }}" method="POST" class="hidden">
        @csrf
        @method('PATCH')
        <input type="hidden" name="description" id="hidden_description">
        <input type="hidden" name="start_time" id="hidden_start_time">
        <input type="hidden" name="end_time" id="hidden_end_time">
    </form>
</x-app-layout>