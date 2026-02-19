<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreMedicationRequest;
use App\Http\Requests\Dashboard\UpdateMedicationRequest;
use App\DataTables\Dashboard\MedicationDataTable;
use App\Models\Medication;
use App\Services\Dashboard\MedicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicationController extends Controller
{
    public function __construct(
        protected MedicationService $medicationService
    ) {
        $this->middleware('can:view.medications')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.medications.data';
        return view('dashboard.clinic.medications.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = $this->medicationService->getFilteredQuery($request);
        return MedicationDataTable::make($query, $request);
    }

    public function create(): View
    {
        return view('dashboard.clinic.medications.create');
    }

    public function store(StoreMedicationRequest $request): RedirectResponse
    {
        $this->medicationService->create($request->validated());
        return redirect()->route('dashboard.clinic.medications.index')
            ->with('success', __('translate.medication_added_successfully'));
    }

    public function edit(Medication $medication): View
    {
        return view('dashboard.clinic.medications.edit', compact('medication'));
    }

    public function update(UpdateMedicationRequest $request, Medication $medication): RedirectResponse
    {
        $this->medicationService->update($medication, $request->validated());
        return redirect()->route('dashboard.clinic.medications.index')
            ->with('success', __('translate.medication_edited_successfully'));
    }

    public function destroy(Medication $medication): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->medicationService->delete($medication);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.medication_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.medications.index')
            ->with('success', __('translate.medication_deleted_successfully'));
    }
}
