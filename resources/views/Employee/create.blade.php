<x-app-layout>
    <div class="min-h-screen p-6 flex items-center justify-center dark:bg-gray-900 dark:text-white">
        <div class="container max-w-screen-lg mx-auto">

            @if ($errors->any())
                <div class="bg-red-100 border-t-4 border-red-600 rounded-b px-4 py-3 text-red-700" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div>
                <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-300">Medewerker Formulier</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Vul het formulier in om een nieuwe medewerker toe te voegen.</p>

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 dark:bg-gray-800">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600 dark:text-gray-300">
                                <p class="font-medium text-lg">Persoonlijke Gegevens</p>
                                <p>Vul alle velden in.</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="person_id">Persoon</label>
                                        <select name="person_id" id="person_id"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                                            @foreach ($persons as $person)
                                                <option value="{{ $person->id }}">{{ $person->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="employee_type">Functie</label>
                                        <input type="text" name="employee_type" id="employee_type"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300"
                                            placeholder="Bijv. Tandarts, Assistent, etc." />
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="number">Nummer</label>
                                        <input type="text" name="number" id="number"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300"
                                            placeholder="Bijv. ABC-1234" />
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="specialization">Specialisatie</label>
                                        <input type="text" name="specialization" id="specialization"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300"
                                            placeholder="Bijv. Orthodontie, Implantologie, etc." />
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="availability">Beschikbaarheid</label>
                                        <input type="text" name="availability" id="availability"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300"
                                            placeholder="Bijv. Ma-Vr 9:00-17:00" />
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="comment">Opmerkingen</label>
                                        <textarea name="comment" id="comment" rows="4"
                                            class="h-20 border mt-1 rounded px-4 w-full bg-gray-50 dark:bg-gray-700 dark:text-gray-300"
                                            placeholder="Bijv. specifieke vaardigheden of opmerkingen"></textarea>
                                    </div>

                                    <div class="md:col-span-5 text-right">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Verstuur</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
