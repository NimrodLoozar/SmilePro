<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('Invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('Invoice.show', compact('invoice'));
    }

    public function create()
    {
        return view('Invoice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'treatment_id' => 'required',
            'number' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        Invoice::create($request->all());
        return redirect()->route('invoices.index');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('Invoice.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required',
            'treatment_id' => 'required',
            'number' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());
        return redirect()->route('invoices.index');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('invoices.index');
    }
}
