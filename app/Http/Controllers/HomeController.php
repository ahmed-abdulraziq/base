<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'doctors' => Doctor::count(),
            'patients' => Patient::count(),
            'specializations' => Specialization::count(),
        ];
        
        $specializations = Specialization::take(8)->get();

        // Prepare chart data for the last 6 months
        $chartMonths = [];
        $chartDoctors = [];
        $chartPatients = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartMonths[] = $date->translatedFormat('M');
            
            $chartDoctors[] = Doctor::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $chartPatients[] = Patient::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return view('welcome', compact('stats', 'specializations', 'chartMonths', 'chartDoctors', 'chartPatients'));
    }
}
