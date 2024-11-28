<x-layout>
    <div class="min-h-screen p-6 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Afspraak Formulier</h2>
                <p class="text-gray-500 mb-6">Vul het formulier in om een afspraak te maken.</p>

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Persoonlijke Gegevens</p>
                                <p>Vul alle velden in.</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="patient_id">Patiënt</label>
                                        <select name="patient_id" id="patient_id" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->person->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="employee_id">Medewerker</label>
                                        <select name="employee_id" id="employee_id" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->person->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="date">Afspraakdatum</label>
                                        <input type="date" name="date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="time">Tijd</label>
                                        <input type="time" name="time" id="time" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="comment">Opmerkingen</label>
                                        <textarea name="comment" id="comment" rows="4" class="h-20 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Bijv. specifieke klachten of verzoeken"></textarea>
                                    </div>

                                    <div class="md:col-span-5 text-right">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Verstuur</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
