<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Medication;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(): View
    {
        $usersCount = User::count();
        $adminsCount = Admin::count();
        $usersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $adminsThisMonth = Admin::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // إحصائيات العيادة
        $patientsCount = Patient::count();
        $doctorsCount = Doctor::count();
        $appointmentsCount = Appointment::count();
        $appointmentsToday = Appointment::whereDate('appointment_date', Carbon::today())->count();
        $prescriptionsCount = Prescription::count();
        $medicationsCount = Medication::count();

        // آخر 6 أشهر للإحصائيات (للـ chart)
        $chartMonths = [];
        $chartUsers = [];
        $chartAdmins = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartMonths[] = $date->translatedFormat('M'); // اختصار اسم الشهر حسب اللغة
            $chartUsers[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $chartAdmins[] = Admin::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return view('dashboard.home', compact(
            'usersCount',
            'adminsCount',
            'usersThisMonth',
            'adminsThisMonth',
            'patientsCount',
            'doctorsCount',
            'appointmentsCount',
            'appointmentsToday',
            'prescriptionsCount',
            'medicationsCount',
            'chartMonths',
            'chartUsers',
            'chartAdmins'
        ));
    }
}
