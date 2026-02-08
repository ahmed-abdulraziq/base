<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAppointmentRequest;
use App\Http\Requests\Dashboard\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.appointments')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.appointments.data';
        $doctorOptions = \App\Models\Doctor::active()->get()->pluck('full_name', 'doctor_id')->toArray();
        return view('dashboard.clinic.appointments.index', compact('route', 'doctorOptions'));
    }

    public function data(Request $request)
    {
        $query = Appointment::query()->with(['patient', 'doctor', 'doctor.specialization']);

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->whereHas('patient', fn ($p) => $p->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%"))
                    ->orWhereHas('doctor', fn ($d) => $d->where('first_name', 'like', "%{$term}%")
                        ->orWhere('last_name', 'like', "%{$term}%"));
            });
        }
        if ($request->filled('filter_doctor')) {
            $query->where('doctor_id', $request->filter_doctor);
        }
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('appointment_date', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('appointment_date', '<=', $request->filter_date_to);
        }

        return DataTables::eloquent($query)
            ->editColumn('appointment_date', fn ($a) => $a->appointment_date?->format('d/m/Y'))
            ->addColumn('patient_name', fn ($a) => $a->patient?->full_name ?? '-')
            ->addColumn('doctor_name', fn ($a) => $a->doctor?->full_name ?? '-')
            ->addColumn('actions', fn ($a) => view('dashboard.clinic.appointments.datatable.actions', ['item' => $a])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        $patients = \App\Models\Patient::orderBy('first_name')->get()->pluck('full_name', 'patient_id')->toArray();
        $doctors = \App\Models\Doctor::active()->get()->pluck('full_name', 'doctor_id')->toArray();
        $employees = \App\Models\Employee::active()->get()->pluck('full_name', 'employee_id')->toArray();
        return view('dashboard.clinic.appointments.create', compact('patients', 'doctors', 'employees'));
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->validated());
        return redirect()->route('dashboard.clinic.appointments.index')
            ->with('success', __('translate.appointment_added_successfully'));
    }

    public function edit(Appointment $appointment): View
    {
        $patients = \App\Models\Patient::orderBy('first_name')->get()->pluck('full_name', 'patient_id')->toArray();
        $doctors = \App\Models\Doctor::active()->get()->pluck('full_name', 'doctor_id')->toArray();
        $employees = \App\Models\Employee::active()->get()->pluck('full_name', 'employee_id')->toArray();
        return view('dashboard.clinic.appointments.edit', compact('appointment', 'patients', 'doctors', 'employees'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update($request->validated());
        return redirect()->route('dashboard.clinic.appointments.index')
            ->with('success', __('translate.appointment_edited_successfully'));
    }

    public function destroy(Appointment $appointment): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $appointment->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.appointment_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.appointments.index')
            ->with('success', __('translate.appointment_deleted_successfully'));
    }
}
