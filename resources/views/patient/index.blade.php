<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
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
</x-app-layout>
