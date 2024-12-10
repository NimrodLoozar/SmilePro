<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Create New Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                required>
                        </div>



                        <!-- Type -->
                        <div class="mt-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type" id="type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="Tandarts">Tandarts</option>
                                <option value="Assistents">Assistents</option>
                                <option value="Dokter">HulpDesk</option>
                            </select>
                        </div>

                        <!-- Specialization -->
                        <div class="mt-4">
                            <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                            <input type="text" name="specialization" id="specialization" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <!-- Availability -->
                        <div class="mt-4">
                            <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                            <select name="availability" id="availability" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Select Availability</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>


                        <!-- Active -->
                        <div class="mt-4">
                            <label for="active" class="block text-sm font-medium text-gray-700">Active</label>
                            <select name="active" id="active" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Select Availability</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <!-- Comment -->
                        <div class="mt-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea name="comment" id="comment" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
