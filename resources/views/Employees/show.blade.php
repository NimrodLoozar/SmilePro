<x-app-layout>
    <div class="min-h-screen p-6 flex items-center justify-center dark:bg-gray-900 dark:text-white">
        <div class="container max-w-screen-lg mx-auto">
            <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-300">Medewerker Details</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Bekijk de gegevens van de medewerker.</p>

            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 dark:bg-gray-800">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600 dark:text-gray-300">
                        <p class="font-medium text-lg">Persoonlijke Gegevens</p>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5">
                                <label for="person_id">Persoon</label>
                                <select id="person_id" name="person_id" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                    @foreach ($persons as $person)
                                        <option value="{{ $person->id }}" 
                                            {{ $employee->person_id == $person->id ? 'selected' : '' }}>
                                            {{ $person->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-5">
                                <p><strong>Naam:</strong> {{ $employee->name }}</p>
                            </div>

                            <div class="md:col-span-5">
                                <p><strong>Functie:</strong> {{ $employee->employee_type }}</p>
                            </div>

                            <div class="md:col-span-5">
                                <p><strong>Email:</strong> {{ $employee->email }}</p>
                            </div>

                            <div class="md:col-span-5">
                                <p><strong>Specialisatie:</strong> {{ $employee->specialization }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
