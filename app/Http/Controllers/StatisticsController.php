<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Invoice;
use Illuminate\View\View;
use App\Models\Patient;

class StatisticsController extends Controller
{
    public function index(): View
    {
        $totalPatients = Patient::count();
        $averageWaitTime = Appointment::avg('wait_time');
        $totalAppointments = Appointment::count();
        $totalPayments = Invoice::count();
        $averageAppointmentDuration = Appointment::avg('duration');

        return view('adminDashboard', [
            'total_patients' => $totalPatients,
            'average_wait_time' => $averageWaitTime,
            'total_appointments' => $totalAppointments,
            'total_payments' => $totalPayments,
            'average_appointment_duration' => $averageAppointmentDuration,
        ]);
    }
}
