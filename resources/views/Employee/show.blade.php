<x-app-layout>
    <div class="min-h-screen p-6 flex items-center justify-center dark:bg-gray-900 dark:text-white">
        <div class="container max-w-screen-lg mx-auto">
            <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-300">Medewerker Details</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Bekijk en bewerk de gegevens van de medewerker.</p>

            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 dark:bg-gray-800">
                <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600 dark:text-gray-300">
                            <p class="font-medium text-lg">Persoonlijke Gegevens</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="person_id">Persoon</label>
                                    <div class="mt-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-300 rounded">
                                        {{ $employee->person->name }}
                                    </div>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="name">Naam</label>
                                    <input type="text" id="name" name="name" value="{{ $employee->name }}" class="mt-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-300 rounded w-full">
                                </div>

                                <div class="md:col-span-5">
                                    <label for="employee_type">Functie</label>
                                    <input type="text" id="employee_type" name="employee_type" value="{{ $employee->employee_type }}" class="mt-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-300 rounded w-full">
                                </div>

                                <div class="md:col-span-5">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $employee->email }}" class="mt-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-300 rounded w-full">
                                </div>

                                <div class="md:col-span-5">
                                    <label for="specialization">Specialisatie</label>
                                    <input type="text" id="specialization" name="specialization" value="{{ $employee->specialization }}" class="mt-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-300 rounded w-full">
                                </div>

                                <div class="md:col-span-5 text-right">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Opslaan</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
