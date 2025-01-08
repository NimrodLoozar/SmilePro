<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patiënt;

class PatiëntController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'geboortedatum' => 'required|date',
            'email' => 'required|email|max:255',
            'telefoonnummer' => 'nullable|string|max:20',
        ]);

        if (Patiënt::bestaatAl($validatedData['email'])) {
            return redirect()->back()->with('error', 'Deze patiënt bestaat al');
        }

        Patiënt::create($validatedData);

        return redirect()->back()->with('success', 'De patiënt is succesvol toegevoegd.');
    }
}
