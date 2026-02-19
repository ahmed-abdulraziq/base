<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreDoctorRequest;
use App\Http\Requests\Dashboard\UpdateDoctorRequest;
use App\DataTables\Dashboard\DoctorDataTable;
use App\Models\Doctor;
use App\Services\Dashboard\DoctorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function __construct(
        protected DoctorService $doctorService
    ) {
        $this->middleware('can:view.doctors')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy', 'approve']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.doctors.data';
        $specializationOptions = $this->doctorService->getSpecializationOptions();
        return view('dashboard.clinic.doctors.index', compact('route', 'specializationOptions'));
    }

    public function data(Request $request)
    {
        $query = $this->doctorService->getFilteredQuery($request);
        return DoctorDataTable::make($query, $request);
    }

    public function create(): View
    {
        $specializations = $this->doctorService->getSpecializationOptions();
        return view('dashboard.clinic.doctors.create', compact('specializations'));
    }

    public function store(StoreDoctorRequest $request): RedirectResponse
    {
        $this->doctorService->create($request->validated());
        return redirect()->route('dashboard.clinic.doctors.index')
            ->with('success', __('translate.doctor_added_successfully'));
    }

    public function edit(Doctor $doctor): View
    {
        $specializations = $this->doctorService->getSpecializationOptions();
        return view('dashboard.clinic.doctors.edit', compact('doctor', 'specializations'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): RedirectResponse
    {
        $this->doctorService->update($doctor, $request->validated());
        return redirect()->route('dashboard.clinic.doctors.index')
            ->with('success', __('translate.doctor_edited_successfully'));
    }

    public function approve(Doctor $doctor): RedirectResponse
    {
        $this->doctorService->approve($doctor);
        return back()->with('success', __('translate.doctor_approved_successfully'));
    }

    public function destroy(Doctor $doctor): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->doctorService->delete($doctor);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.doctor_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.doctors.index')
            ->with('success', __('translate.doctor_deleted_successfully'));
    }
}
