<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Employees') }}
            </h2>
            <label class="flex items-center">
                <span class="mr-2 text-gray-200">Toon Data</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" id="dataToggle"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        checked />
                    <label for="dataToggle"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </label>
            <a href="{{ route('employees.create') }}"
                class="px-4 py-2 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600">
                NEW +
            </a>
        </div>

        <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-700">
                    <th class="py-2 px-4 text-left text-gray-200">Name</th>
                    <th class="py-2 px-4 text-left text-gray-200">Number</th>
                    <th class="py-2 px-4 text-left text-gray-200">Type</th>
                    <th class="py-2 px-4 text-left text-gray-200">Specialization</th>
                    <th class="py-2 px-4 text-left text-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="border-t border-gray-700 hover:bg-gray-700">
                        <td class="py-2 px-4 text-gray-300">{{ $employee->name }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $employee->number }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $employee->employee_type }}</td>
                        <td class="py-2 px-4 text-gray-300">{{ $employee->specialization }}</td>
                        <td class="py-2 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('employees.show', $employee->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 text-gray-300">
            {{ $employees->links() }}
        </div>
        </div>
        <div id="errorContainer" class="py-12 hidden ml-64">
            <p class="text-red-500">Er kan geen data opgehaald worden.</p>
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
