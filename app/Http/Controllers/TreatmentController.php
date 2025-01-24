<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the treatments.
     */
    public function index(Request $request)
    {
        $query = Treatment::query();

        if ($status = $request->input('status')) {
            $query->byStatus($status);
        }

        if ($request->has('active')) {
            $query->active();
        }

        $treatments = $query->paginate(10);

        return view('treatments.index', [
            'treatments' => $treatments
        ]);
    }

    /**
     * Show the form for creating a new treatment.
     */
    public function create()
    {
        return view('treatments.create'); // You'll need to create this view
    }

    /**
     * Store a newly created treatment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        Treatment::create($validated);

        return Redirect::route('treatments.index')
            ->with('success', 'Behandeling succesvol aangemaakt.');
    }

    /**
     * Display the specified treatment.
     */
    public function show(Treatment $treatment)
    {
        return view('treatments.show', [
            'treatment' => $treatment
        ]);
    }

    /**
     * Show the form for editing the specified treatment.
     */
    public function edit(Treatment $treatment)
    {
        return view('treatments.edit', [
            'treatment' => $treatment
        ]);
    }

    /**
     * Update the specified treatment in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'sometimes|numeric|min:0',
            'date' => 'sometimes|date',
        ]);

        $treatment->update($validated);

        return Redirect::route('treatments.index')
            ->with('success', 'Behandeling succesvol bijgewerkt.');
    }

    /**
     * Remove the specified treatment from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return Redirect::route('treatments.index')
            ->with('success', 'Behandeling succesvol verwijderd.');
    }
}