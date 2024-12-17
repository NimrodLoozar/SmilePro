<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Create New Employee') }}
        </h2>
    </x-slot>

    @if (session('error'))
    <div class="bg-red-900 border-t-4 border-red-600 rounded-b px-4 py-3 text-red-200" role="alert">
        {{ session('error') }}
    </div>
    @endif

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
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror" 
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mt-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type" id="type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('type') border-red-500 @enderror" 
                                required>
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type</option>
                                <option value="Tandarts" {{ old('type') == 'Tandarts' ? 'selected' : '' }}>Tandarts</option>
                                <option value="Assistents" {{ old('type') == 'Assistents' ? 'selected' : '' }}>Assistents</option>
                                <option value="HulpDesk" {{ old('type') == 'HulpDesk' ? 'selected' : '' }}>HulpDesk</option>
                            </select>
                            @error('type')
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

                        <!-- Availability -->
                        <div class="mt-4">
                            <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                            <select name="avai0lability" id="availability" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('availability') border-red-500 @enderror" 
                                required>
                                <option value="" disabled {{ old('availability') ? '' : 'selected' }}>Select Availability</option>
                                <option value="1" {{ old('availability') == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('availability') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('availability')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Active -->
                        <div class="mt-4">
                            <label for="active" class="block text-sm font-medium text-gray-700">Active</label>
                            <select name="active" id="active" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('active') border-red-500 @enderror">
                                <option value="" disabled {{ old('active') ? '' : 'selected' }}>Select Active Status</option>
                                <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('active')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Comment -->
                        <div class="mt-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea name="comment" id="comment" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
