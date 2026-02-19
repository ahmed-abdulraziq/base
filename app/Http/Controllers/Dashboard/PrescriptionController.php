<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePrescriptionRequest;
use App\Http\Requests\Dashboard\UpdatePrescriptionRequest;
use App\DataTables\Dashboard\PrescriptionDataTable;
use App\Models\Prescription;
use App\Services\Dashboard\PrescriptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PrescriptionController extends Controller
{
    public function __construct(
        protected PrescriptionService $prescriptionService
    ) {
        $this->middleware('can:view.prescriptions')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy', 'pdf']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.prescriptions.data';
        $doctorOptions = $this->prescriptionService->getDoctorOptionsForFilter();
        return view('dashboard.clinic.prescriptions.index', compact('route', 'doctorOptions'));
    }

    public function data(Request $request)
    {
        $query = $this->prescriptionService->getFilteredQuery($request);
        return PrescriptionDataTable::make($query, $request);
    }

    public function create(): View
    {
        $options = $this->prescriptionService->getCreateFormOptions();
        return view('dashboard.clinic.prescriptions.create', $options);
    }

    public function store(StorePrescriptionRequest $request): RedirectResponse
    {
        $this->prescriptionService->create($request->validated());
        return redirect()->route('dashboard.clinic.prescriptions.index')
            ->with('success', __('translate.prescription_added_successfully'));
    }

    public function edit(Prescription $prescription): View
    {
        $prescription->load('details.medication');
        $options = $this->prescriptionService->getCreateFormOptions();
        return view('dashboard.clinic.prescriptions.edit', compact('prescription') + $options);
    }

    public function update(UpdatePrescriptionRequest $request, Prescription $prescription): RedirectResponse
    {
        $this->prescriptionService->update($prescription, $request->validated());
        return redirect()->route('dashboard.clinic.prescriptions.index')
            ->with('success', __('translate.prescription_edited_successfully'));
    }

    public function pdf(Prescription $prescription): Response
    {
        return $this->prescriptionService->generatePdf($prescription);
    }

    public function destroy(Prescription $prescription): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->prescriptionService->delete($prescription);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.prescription_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.prescriptions.index')
            ->with('success', __('translate.prescription_deleted_successfully'));
    }
}
