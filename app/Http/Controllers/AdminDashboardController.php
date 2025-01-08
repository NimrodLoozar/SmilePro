<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Invoice;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have access.');
        }

        // Fetch the statistics data
        $totalPatients = Patient::count();
        $averageWaitTime = number_format(Appointment::avg('time') / 60, 0);
        $totalAppointments = Appointment::count();
        $averageAppointmentDuration = number_format(Appointment::avg('time'), 0);
        $users = User::paginate(10); // Adjust the number as needed

        return view('adminDashboard', [
            'totalPatients' => $totalPatients,
            'averageWaitTime' => $averageWaitTime,
            'totalAppointments' => $totalAppointments,
            'averageAppointmentDuration' => $averageAppointmentDuration,
            'users' => $users,
        ]);
    }

    public function showUsers()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have access.');
        }
        $users = User::paginate(10); // Adjust the number as needed
        return view('AcountenOverzicht', compact('users'));
    }
}
