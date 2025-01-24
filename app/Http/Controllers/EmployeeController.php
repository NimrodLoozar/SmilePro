<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use App\Models\User;
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
        $employees = Employee::with('person')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form to create a new employee.
     */
    public function create()
    {
        $users = User::with('person')->get(); // Fetch all users with their related person
        return view('employees.create', compact('users'));
    }


    /**
     * Store a new employee in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'person_id' => 'required|exists:persons,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'number' => 'required|string|max:10|unique:employees',
            'employee_type' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
        ]);
{
    // Validate the incoming request data
    $validated = $request->validate([
        'person_id' => 'required|exists:people,id',
        'number' => 'required|string|max:255',
        'employee_type' => 'required|string|max:255',
        'specialization' => 'nullable|string|max:255',
        'availability' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:500',
    ]);

        // Ensure the person exists
        $person = Person::find($validated['person_id']);
        if (!$person) {
            return redirect()->back()->withErrors(['person_id' => 'Selected person does not exist.']);
        }

        Employee::create($validated);

        return redirect()->route('admin.employees.create')->with('success', 'Employee created successfully.');
    }

    /**
     * Show details of a specific employee.
     */
    public function show(Employee $employee)
    {
        // Load the employee's relationships
        $employee->load('person');

        // Get all persons for the dropdown
        $persons = Person::all();

        return view('employee.show', compact('employee', 'persons'));
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
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->update([
            'name' => $request->input('name'),
            'employee_type' => $request->input('employee_type'),
            'email' => $request->input('email'),
            'specialization' => $request->input('specialization'),
        ]);

        return redirect()->route('employee.index')->with('success', 'Medewerker succesvol bijgewerkt.');
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
