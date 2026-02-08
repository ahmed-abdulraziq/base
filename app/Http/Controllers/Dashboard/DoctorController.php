<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreDoctorRequest;
use App\Http\Requests\Dashboard\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.doctors')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.doctors.data';
        $specializationOptions = \App\Models\Specialization::pluck('specialization_name', 'specialization_id')->toArray();
        return view('dashboard.clinic.doctors.index', compact('route', 'specializationOptions'));
    }

    public function data(Request $request)
    {
        $query = Doctor::query()->with('specialization');

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_specialization')) {
            $query->where('specialization_id', $request->filter_specialization);
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($d) => $d->created_at?->format('d/m/Y H:i'))
            ->addColumn('full_name', fn ($d) => $d->full_name)
            ->addColumn('specialization_name', fn ($d) => $d->specialization?->specialization_name ?? '-')
            ->addColumn('actions', fn ($d) => view('dashboard.clinic.doctors.datatable.actions', ['item' => $d])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        $specializations = \App\Models\Specialization::pluck('specialization_name', 'specialization_id')->toArray();
        return view('dashboard.clinic.doctors.create', compact('specializations'));
    }

    public function store(StoreDoctorRequest $request): RedirectResponse
    {
        Doctor::create($request->validated());
        return redirect()->route('dashboard.clinic.doctors.index')
            ->with('success', __('translate.doctor_added_successfully'));
    }

    public function edit(Doctor $doctor): View
    {
        $specializations = \App\Models\Specialization::pluck('specialization_name', 'specialization_id')->toArray();
        return view('dashboard.clinic.doctors.edit', compact('doctor', 'specializations'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): RedirectResponse
    {
        $doctor->update($request->validated());
        return redirect()->route('dashboard.clinic.doctors.index')
            ->with('success', __('translate.doctor_edited_successfully'));
    }

    public function destroy(Doctor $doctor): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $doctor->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.doctor_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.doctors.index')
            ->with('success', __('translate.doctor_deleted_successfully'));
    }
}
