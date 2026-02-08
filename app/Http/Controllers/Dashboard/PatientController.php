<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePatientRequest;
use App\Http\Requests\Dashboard\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.patients')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.patients.data';
        return view('dashboard.clinic.patients.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($p) => $p->created_at?->format('d/m/Y H:i'))
            ->addColumn('full_name', fn ($p) => $p->full_name)
            ->addColumn('actions', fn ($p) => view('dashboard.clinic.patients.datatable.actions', ['item' => $p])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.clinic.patients.create');
    }

    public function store(StorePatientRequest $request): RedirectResponse
    {
        Patient::create($request->validated());
        return redirect()->route('dashboard.clinic.patients.index')
            ->with('success', __('translate.patient_added_successfully'));
    }

    public function edit(Patient $patient): View
    {
        return view('dashboard.clinic.patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient): RedirectResponse
    {
        $patient->update($request->validated());
        return redirect()->route('dashboard.clinic.patients.index')
            ->with('success', __('translate.patient_edited_successfully'));
    }

    public function destroy(Patient $patient): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $patient->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.patient_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.patients.index')
            ->with('success', __('translate.patient_deleted_successfully'));
    }
}
