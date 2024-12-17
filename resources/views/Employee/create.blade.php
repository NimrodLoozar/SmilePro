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
                        <div class="mt-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror" 
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                         <!-- Number -->
                         <div class="mt-4">
                            <label for="number" class="block text-sm font-medium text-gray-700">Number</label>
                            <input type="text" name="number" id="number" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('number') border-red-500 @enderror" 
                                value="{{ old('number') }}" required>
                            @error('number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Employee Type -->
                        <div class="mt-4">
                            <label for="employee_type" class="block text-sm font-medium text-gray-700">Employee Type</label>
                            <select name="employee_type" id="employee_type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('employee_type') border-red-500 @enderror" 
                                required>
                                <option value="" disabled {{ old('employee_type') ? '' : 'selected' }}>Select Type</option>
                                <option value="Tandarts" {{ old('employee_type') == 'Tandarts' ? 'selected' : '' }}>Tandarts</option>
                                <option value="Assistents" {{ old('employee_type') == 'Assistents' ? 'selected' : '' }}>Assistents</option>
                                <option value="HulpDesk" {{ old('employee_type') == 'HulpDesk' ? 'selected' : '' }}>HulpDesk</option>
                            </select>
                            @error('employee_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Specialization -->
                        <div class="mt-4">
                            <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                            <input type="text" name="specialization" id="specialization" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('specialization') border-red-500 @enderror" 
                                value="{{ old('specialization') }}">
                            @error('specialization')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 text-right">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>