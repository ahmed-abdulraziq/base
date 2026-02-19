<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreMedicalExaminationRequest;
use App\Http\Requests\Dashboard\UpdateMedicalExaminationRequest;
use App\DataTables\Doctor\MedicalExaminationDataTable;
use App\Models\Attachment;
use App\Models\Doctor;
use App\Models\MedicalExamination;
use App\Services\Dashboard\MedicalExaminationService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicalExaminationController extends Controller
{
    public function __construct(
        protected MedicalExaminationService $examinationService
    ) {
    }

    public function index(Request $request): View
    {
        $route = 'doctor.examinations.data';
        return view('doctor.examinations.index', compact('route'));
    }

    public function data(Request $request)
    {
        $doctorId = auth('doctor')->id();
        $query = $this->examinationService->getFilteredQuery($request, $doctorId);
        return MedicalExaminationDataTable::make($query, $request);
    }

    public function create(): View
    {
        $doctorId = auth('doctor')->id();
        $options = $this->examinationService->getCreateFormOptions($doctorId);
        return view('doctor.examinations.create', $options);
    }

    public function store(StoreMedicalExaminationRequest $request): RedirectResponse
    {
        $this->examinationService->create($request->validated(), auth('doctor')->id());
        return redirect()->route('doctor.examinations.index')
            ->with('success', __('translate.examination_added_successfully'));
    }

    public function edit(MedicalExamination $examination): View
    {
        $doctorId = auth('doctor')->id(); // ensure doctor owns it? Or check logic inside view
        $options = $this->examinationService->getCreateFormOptions($doctorId); // reuse options?
        // Actually the service might not have edit form options specifically differently
        return view('doctor.examinations.edit', compact('examination') + $options);
    }

    public function upload(Request $request, MedicalExamination $examination): RedirectResponse
    {
        $request->validate(['file' => 'required|file|max:10240']); // 10MB max
        
        // Use the trait method
        $examination->uploadFile($request->file('file'), 'test_result', 'file', auth('doctor')->user());
        
        return back()->with('success', __('translate.file_uploaded_successfully'));
    }

    public function deleteAttachment(Attachment $attachment): RedirectResponse
    {
        // Only the doctor who uploaded the file can delete it
        if (
            $attachment->owner_type !== Doctor::class ||
            (int) $attachment->owner_id !== (int) auth('doctor')->id()
        ) {
            abort(403);
        }

        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return back()->with('success', __('translate.file_deleted_successfully'));
    }

    public function update(UpdateMedicalExaminationRequest $request, MedicalExamination $examination): RedirectResponse
    {
        if ($examination->doctor_id != auth('doctor')->id()) {
            abort(403);
        }

        $this->examinationService->update($examination, $request->validated());
        return redirect()->route('doctor.examinations.index')
            ->with('success', __('translate.examination_edited_successfully'));
    }

    public function destroy(MedicalExamination $examination): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        if ($examination->doctor_id != auth('doctor')->id()) {
            abort(403);
        }

        $this->examinationService->delete($examination);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.examination_deleted_successfully')]);
        }
        return redirect()->route('doctor.examinations.index')
            ->with('success', __('translate.examination_deleted_successfully'));
    }
}
