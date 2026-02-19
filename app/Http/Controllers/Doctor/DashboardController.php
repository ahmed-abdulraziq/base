<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        $doctor = auth('doctor')->user();
        $doctorId = $doctor->id;

        $appointmentsToday = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', Carbon::today())
            ->count();

        $appointmentsTotal = Appointment::where('doctor_id', $doctorId)->count();
        $prescriptionsTotal = Prescription::where('doctor_id', $doctorId)->count();

        $todayAppointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', Carbon::today())
            ->with('patient')
            ->orderBy('appointment_time')
            ->get();

        return view('doctor.home', compact(
            'doctor',
            'appointmentsToday',
            'appointmentsTotal',
            'prescriptionsTotal',
            'todayAppointments'
        ));
    }
}
