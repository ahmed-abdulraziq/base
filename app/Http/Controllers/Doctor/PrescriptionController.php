<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePrescriptionRequest;
use App\DataTables\Doctor\PrescriptionDataTable;
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
    }

    public function index(Request $request): View
    {
        $route = 'doctor.prescriptions.data';
        return view('doctor.prescriptions.index', compact('route'));
    }

    public function create(): View
    {
        $doctorId = auth('doctor')->id();
        $options = $this->prescriptionService->getCreateFormOptions($doctorId);
        return view('doctor.prescriptions.create', $options);
    }

    public function store(StorePrescriptionRequest $request): RedirectResponse
    {
        $this->prescriptionService->create($request->validated(), auth('doctor')->id());
        return redirect()->route('doctor.prescriptions.index')
            ->with('success', __('translate.prescription_added_successfully'));
    }

    public function data(Request $request)
    {
        $doctorId = auth('doctor')->id();
        $query = $this->prescriptionService->getFilteredQuery($request, $doctorId);
        return PrescriptionDataTable::make($query, $request);
    }

    public function pdf(Prescription $prescription): Response
    {
        if ($prescription->doctor_id != auth('doctor')->id()) {
            abort(403);
        }
        return $this->prescriptionService->generatePdf($prescription);
    }
}
