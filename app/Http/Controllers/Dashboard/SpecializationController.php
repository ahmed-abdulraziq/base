<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSpecializationRequest;
use App\Http\Requests\Dashboard\UpdateSpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SpecializationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.specializations')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.specializations.data';
        return view('dashboard.clinic.specializations.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = Specialization::query();

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->where('specialization_name', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('created_at', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('created_at', '<=', $request->filter_date_to);
        }

        return DataTables::eloquent($query)
            ->editColumn('created_at', fn ($s) => $s->created_at?->format('d/m/Y H:i'))
            ->addColumn('actions', fn ($s) => view('dashboard.clinic.specializations.datatable.actions', ['item' => $s])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('dashboard.clinic.specializations.create');
    }

    public function store(StoreSpecializationRequest $request): RedirectResponse
    {
        Specialization::create($request->validated());
        return redirect()->route('dashboard.clinic.specializations.index')
            ->with('success', __('translate.specialization_added_successfully'));
    }

    public function edit(Specialization $specialization): View
    {
        return view('dashboard.clinic.specializations.edit', compact('specialization'));
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization): RedirectResponse
    {
        $specialization->update($request->validated());
        return redirect()->route('dashboard.clinic.specializations.index')
            ->with('success', __('translate.specialization_edited_successfully'));
    }

    public function destroy(Specialization $specialization): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $specialization->delete();
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.specialization_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.specializations.index')
            ->with('success', __('translate.specialization_deleted_successfully'));
    }
}
