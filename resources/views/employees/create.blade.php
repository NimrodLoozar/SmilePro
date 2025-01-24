<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Werknemers Toevoegen') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mt-5 text-white">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h3 mb-0">Create New Employee</h1>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.employees.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="employee_type" class="form-label">Employee Type</label>
                        <select name="employee_type" id="employee_type" class="form-control text-gray-800" required>
                            <option value="Assistant">Assistant</option>
                            <option value="Tandarts">Tandarts</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary text-white">Create Employee</button>
                </form>

                <form action="{{ route('admin.employees.generate-link') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-secondary text-white">Generate One-Time Registration
                        Link</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
