<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePatientRequest;
use App\Http\Requests\Dashboard\UpdatePatientRequest;
use App\DataTables\Dashboard\PatientDataTable;
use App\Models\Patient;
use App\Services\Dashboard\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function __construct(
        protected PatientService $patientService
    ) {
        $this->middleware('can:view.patients')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.patients.data';
        return view('dashboard.clinic.patients.index', compact('route'));
    }

    public function data(Request $request)
    {
        $query = $this->patientService->getFilteredQuery($request);
        return PatientDataTable::make($query, $request);
    }

    public function create(): View
    {
        return view('dashboard.clinic.patients.create');
    }

    public function store(StorePatientRequest $request): RedirectResponse
    {
        $this->patientService->create($request->validated());
        return redirect()->route('dashboard.clinic.patients.index')
            ->with('success', __('translate.patient_added_successfully'));
    }

    public function show($id): View
    {
        $patient = Patient::with(['appointments.doctor', 'medicalExaminations.doctor', 'medicalExaminations.attachments', 'prescriptions.details.medication'])->findOrFail($id);
        return view('dashboard.clinic.patients.show', compact('patient'));
    }

    public function edit(Patient $patient): View
    {
        return view('dashboard.clinic.patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient): RedirectResponse
    {
        $this->patientService->update($patient, $request->validated());
        return redirect()->route('dashboard.clinic.patients.index')
            ->with('success', __('translate.patient_edited_successfully'));
    }

    public function destroy(Patient $patient): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->patientService->delete($patient);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.patient_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.patients.index')
            ->with('success', __('translate.patient_deleted_successfully'));
    }
}
