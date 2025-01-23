<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Patients') }}
            </h2>
            <label class="flex items-center">
                <span class="mr-2 text-gray-200">Show Data</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" id="dataToggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        checked />
                    <label for="dataToggle"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </label>
        </div>
    </x-slot>

    <div id="dataContainer" class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        medical file
                    </th>
                    <th scope="col" class="px-6 py-3">
                        isactive
                    </th>
                    <th scope="col" class="px-6 py-3">
                        comment
                    </th>
                    <th scope="col" class="px-6 py-3">
                        actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $patient->person->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $patient->number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->medical_file }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($patient->is_active)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td class="px-6 py-4 text-wrap">
                            {{ $patient->comment }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="patients/{{ $patient->id }}/edit"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="patients/{{ $patient->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pt-3">
            {{ $patients->links() }}
        </div>
    </div>
    <div id="errorContainer" class="container mx-auto mt-8 hidden">
        <p class="text-red-500">Unable to fetch data.</p>
    </div>
</x-app-layout>

<script>
    document.getElementById('dataToggle').addEventListener('change', function() {
        const dataContainer = document.getElementById('dataContainer');
        const errorContainer = document.getElementById('errorContainer');
        if (this.checked) {
            dataContainer.classList.remove('hidden');
            errorContainer.classList.add('hidden');
        } else {
            dataContainer.classList.add('hidden');
            errorContainer.classList.remove('hidden');
        }
    });
</script>

<style>
    .toggle-checkbox:checked {
        right: 0;
        border-color: #68D391;
    }

    .toggle-checkbox:checked+.toggle-label {
        background-color: #68D391;
    }
</style>