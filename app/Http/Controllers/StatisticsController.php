<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function index(): JsonResponse
    {
        $totalPatients = Appointment::count();
        $averageWaitTime = Appointment::avg('wait_time');

        return response()->json([
            'total_patients' => $totalPatients,
            'average_wait_time' => $averageWaitTime,
        ]);
    }
}
