@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Factuur Overzicht</h1>
    @if($invoices->isEmpty())
        <p>Geen facturen gevonden. Probeer later opnieuw.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nummer</th>
                    <th>Datum</th>
                    <th>Bedrag</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>{{ $invoice->amount }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-primary">Bekijk</a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Bewerk</a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
