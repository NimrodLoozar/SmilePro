<x-app-layout>
    <div class="container mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-900 border-t-4 border-green-600 rounded-b px-4 py-3 text-green-200" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-900 border-t-4 border-red-600 rounded-b px-4 py-3 text-red-200" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-white">Employees</h1>
            <a href="{{ route('employees.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">NEW +</a>
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
</x-app-layout>