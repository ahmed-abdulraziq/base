<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSpecializationRequest;
use App\Http\Requests\Dashboard\UpdateSpecializationRequest;
use App\DataTables\Dashboard\SpecializationDataTable;
use App\Models\Specialization;
use App\Services\Dashboard\SpecializationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpecializationController extends Controller
{
    public function __construct(
        protected SpecializationService $specializationService
    ) {
        $this->middleware('can:view.specializations')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.specializations.data';
        return view('dashboard.clinic.specializations.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = $this->specializationService->getFilteredQuery($request);
        return SpecializationDataTable::make($query, $request);
    }

    public function create(): View
    {
        return view('dashboard.clinic.specializations.create');
    }

    public function store(StoreSpecializationRequest $request): RedirectResponse
    {
        $this->specializationService->create($request->validated());
        return redirect()->route('dashboard.clinic.specializations.index')
            ->with('success', __('translate.specialization_added_successfully'));
    }

    public function edit(Specialization $specialization): View
    {
        return view('dashboard.clinic.specializations.edit', compact('specialization'));
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization): RedirectResponse
    {
        $this->specializationService->update($specialization, $request->validated());
        return redirect()->route('dashboard.clinic.specializations.index')
            ->with('success', __('translate.specialization_edited_successfully'));
    }

    public function destroy(Specialization $specialization): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->specializationService->delete($specialization);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.specialization_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.specializations.index')
            ->with('success', __('translate.specialization_deleted_successfully'));
    }
}
