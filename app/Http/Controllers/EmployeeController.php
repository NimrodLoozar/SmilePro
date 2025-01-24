<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index()
    {
        $employees = Employee::with('person')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form to create a new employee.
     */
    public function create()
    {
        $persons = Person::all(); // Changed from User to Person
        return view('employees.create', compact('persons'));
    }

    /**
     * Store a new employee in the database.
     */
    public function store(Request $request)
    {
        // Single validation block matching form fields
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'employee_type' => 'required|string|max:255',
            'number' => 'required|string|max:255|unique:employees',
            'specialization' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:500',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Show details of a specific employee.
     */
    public function show(Employee $employee)
    {
        $employee->load('person');
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form to edit an employee.
     */
    public function edit(Employee $employee)
    {
        $persons = Person::pluck('name', 'id');
        return view('employees.edit', compact('employee', 'persons'));
    }

    /**
     * Update an employee in the database.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'employee_type' => 'required|string|max:255',
            'number' => 'required|string|max:255|unique:employees,number,'.$employee->id,
            'specialization' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:500',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Delete an employee from the database.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}