<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\DataTables\Dashboard\PatientDataTable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    public function index(Request $request): View
    {
        $route = 'doctor.patients.data';
        return view('doctor.patients.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = Patient::query()
            ->whereHas('appointments', function($q) {
                $q->where('doctor_id', auth('doctor')->id());
            })
            ->latest();

        // Custom DataTable response to use doctor-specific actions
        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($p) => $p->created_at?->format('d/m/Y H:i'))
            ->editColumn('gender', fn ($p) => $p->gender?->label()) // Assuming enum has label method
            ->addColumn('full_name', fn ($p) => $p->name) // Fallback if full_name accessor doesn't exist
            ->addColumn('actions', function ($p) {
                return '<a href="'.route('doctor.patients.show', $p->id).'" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> ' . __('translate.show') . '</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    
    public function show($id): View
    {
         $patient = Patient::with(['appointments.doctor', 'medicalExaminations.doctor', 'medicalExaminations.attachments', 'prescriptions.details.medication'])->findOrFail($id);
         return view('doctor.patients.show', compact('patient'));
    }
}
