<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreMedicationRequest;
use App\Http\Requests\Dashboard\UpdateMedicationRequest;
use App\Models\Medication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MedicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.medications')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.medications.data';
        return view('dashboard.clinic.medications.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = Medication::query();

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('medication_name', 'like', "%{$term}%")
                    ->orWhere('generic_name', 'like', "%{$term}%")
                    ->orWhere('manufacturer', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($m) => $m->created_at?->format('d/m/Y H:i'))
            ->addColumn('actions', fn ($m) => view('dashboard.clinic.medications.datatable.actions', ['item' => $m])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.clinic.medications.create');
    }

    public function store(StoreMedicationRequest $request): RedirectResponse
    {
        Medication::create($request->validated());
        return redirect()->route('dashboard.clinic.medications.index')
            ->with('success', __('translate.medication_added_successfully'));
    }

    public function edit(Medication $medication): View
    {
        return view('dashboard.clinic.medications.edit', compact('medication'));
    }

    public function update(UpdateMedicationRequest $request, Medication $medication): RedirectResponse
    {
        $medication->update($request->validated());
        return redirect()->route('dashboard.clinic.medications.index')
            ->with('success', __('translate.medication_edited_successfully'));
    }

    public function destroy(Medication $medication): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $medication->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.medication_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.medications.index')
            ->with('success', __('translate.medication_deleted_successfully'));
    }
}
