<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have access.');
        }
        return view('adminDashboard');
    }

    public function showUsers()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have access.');
        }
        $users = User::all();
        return view('AcountenOverzicht', compact('users'));
    }
}
