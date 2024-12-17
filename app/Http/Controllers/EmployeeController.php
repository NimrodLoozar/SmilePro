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
     * Display a listing of employees!
     */
    public function index()
    {
        $employees = Employee::with('employee')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form to create a new employee.
     */
    public function create()
    {
        $persons = Person::pluck('name', 'id');
        return view('employee.create', compact('persons'));
    }

    /**
     * Store a new employee in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:persons,id',
            'number' => 'required|string',
            'employee_type' => 'required|string',
            'specialization' => 'nullable|string',
            'availability' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        Employee::create([
            'person_id' => $validated['person_id'],
            'number' => $validated['number'],
            'employee_type' => $validated['employee_type'],
            'specialization' => $validated['specialization'],
            'availability' => $validated['availability'],
            'is_active' => $validated['is_active'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Show details of a specific employee.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
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
        $validator = Validator::make($request->all(), [
            'person_id' => 'required|exists:persons,id',
            'name' => 'required|string',
            'employee_type' => 'required|string',
            'specialization' => 'nullable|string',
            'availability' => 'nullable|string',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $employee->update($request->all());
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
