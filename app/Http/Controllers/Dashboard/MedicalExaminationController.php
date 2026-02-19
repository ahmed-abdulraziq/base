<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreMedicalExaminationRequest;
use App\Http\Requests\Dashboard\UpdateMedicalExaminationRequest;
use App\DataTables\Dashboard\MedicalExaminationDataTable;
use App\Models\MedicalExamination;
use App\Services\Dashboard\MedicalExaminationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicalExaminationController extends Controller
{
    public function __construct(
        protected MedicalExaminationService $examinationService
    ) {
        $this->middleware('can:view.examinations')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.examinations.data';
        $doctorOptions = $this->examinationService->getDoctorOptionsForFilter();
        $patientOptions = $this->examinationService->getPatientOptionsForFilter();
        return view('dashboard.clinic.examinations.index', compact('route', 'doctorOptions', 'patientOptions'));
    }

    public function data(Request $request)
    {
        $query = $this->examinationService->getFilteredQuery($request);
        return MedicalExaminationDataTable::make($query, $request);
    }

    public function create(): View
    {
        $options = $this->examinationService->getCreateFormOptions();
        return view('dashboard.clinic.examinations.create', $options);
    }

    public function store(StoreMedicalExaminationRequest $request): RedirectResponse
    {
        $this->examinationService->create($request->validated());
        return redirect()->route('dashboard.clinic.examinations.index')
            ->with('success', __('translate.examination_added_successfully'));
    }

    public function edit(MedicalExamination $examination): View
    {
        $options = $this->examinationService->getCreateFormOptions();
        return view('dashboard.clinic.examinations.edit', compact('examination') + $options);
    }

    public function update(UpdateMedicalExaminationRequest $request, MedicalExamination $examination): RedirectResponse
    {
        $this->examinationService->update($examination, $request->validated());
        return redirect()->route('dashboard.clinic.examinations.index')
            ->with('success', __('translate.examination_edited_successfully'));
    }

    public function destroy(MedicalExamination $examination): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->examinationService->delete($examination);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.examination_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.examinations.index')
            ->with('success', __('translate.examination_deleted_successfully'));
    }
}
