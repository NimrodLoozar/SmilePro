<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;



class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(6);
        return view('Invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $patient = Patient::findOrFail($invoice->patient_id);

        return view('Invoice.show', compact('invoice', 'patient'));
    }

    public function create()
        {
            $patients = Patient::all();
            $treatments = Treatment::all();
        
            return view('invoice.create', compact('patients', 'treatments'));
        }
    

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:invoice,number',
            'date' => 'required',
            'amount' => 'required',
        ]);

        Invoice::create($request->all());
        return redirect()->route('invoice.index');
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $treatments = Treatment::all();

        return view('invoice.edit', compact('invoice', 'treatments'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|unique:invoices,number,' . $id,
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

    public function latestNumber()
    {
        $latestInvoice = Invoice::orderBy('number', 'desc')->first();
        $nextNumber = $latestInvoice ? $latestInvoice->number + 1 : 1;
        return response()->json(['nextNumber' => $nextNumber]);
    }
}