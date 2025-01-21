<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the treatments.
     */
    public function index(Request $request)
    {
        $query = Treatment::query();

        // Filter by status if provided
        if ($status = $request->input('status')) {
            $query->byStatus($status);
        }

        // Filter active treatments
        if ($request->has('active')) {
            $query->active();
        }

        // Filter upcoming treatments
        if ($request->has('upcoming')) {
            $query->upcoming();
        }

        $treatments = $query->paginate(10);

        return response()->json($treatments);
    }

    /**
     * Store a newly created treatment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'treatment_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        $treatment = Treatment::create($validated);

        return response()->json($treatment, 201);
    }

    /**
     * Display the specified treatment.
     */
    public function show(Treatment $treatment)
    {
        return response()->json($treatment);
    }

    /**
     * Update the specified treatment in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $validated = $request->validate([
            'patient_id' => 'sometimes|exists:patients,id',
            'employee_id' => 'sometimes|exists:employees,id',
            'date' => 'sometimes|date',
            'time' => 'sometimes|date_format:H:i',
            'treatment_type' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|max:255',
            'is_active' => 'sometimes|boolean',
            'comment' => 'nullable|string',
        ]);

        $treatment->update($validated);

        return response()->json($treatment);
    }

    /**
     * Remove the specified treatment from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return response()->json(['message' => 'Treatment deleted successfully.'], 200);
    }

    /**
     * List all upcoming treatments.
     */
    public function upcoming()
    {
        $treatments = Treatment::upcoming()->get();

        return response()->json($treatments);
    }

    /**
     * Toggle the active status of a treatment.
     */
    public function toggleActive(Treatment $treatment)
    {
        $treatment->is_active = !$treatment->is_active;
        $treatment->save();

        return response()->json($treatment);
    }

    /**
     * Fetch the cost of a treatment in formatted currency.
     */
    public function getFormattedCost(Treatment $treatment)
    {
        return response()->json(['formatted_cost' => $treatment->formatted_cost]);
    }
}
