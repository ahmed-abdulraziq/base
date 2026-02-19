<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAppointmentRequest;
use App\Http\Requests\Dashboard\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\DataTables\Doctor\AppointmentDataTable;
use App\Services\Dashboard\AppointmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentService $appointmentService
    ) {
    }

    public function index(Request $request): View
    {
        $route = 'doctor.appointments.data';
        return view('doctor.appointments.index', compact('route'));
    }

    public function create(): View
    {
        $doctorId = auth('doctor')->id();
        $options = $this->appointmentService->getCreateFormOptions($doctorId);
        return view('doctor.appointments.create', $options);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $this->appointmentService->create($request->validated(), auth('doctor')->id());
        return redirect()->route('doctor.appointments.index')
            ->with('success', __('translate.appointment_added_successfully'));
    }

    public function edit(Appointment $appointment): View
    {
        $this->authorizeDoctorAppointment($appointment);

        $doctorId = auth('doctor')->id();
        $options = $this->appointmentService->getCreateFormOptions($doctorId);
        return view('doctor.appointments.edit', compact('appointment') + $options);
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $this->authorizeDoctorAppointment($appointment);

        $this->appointmentService->update($appointment, $request->validated(), auth('doctor')->id());
        return redirect()->route('doctor.appointments.index')
            ->with('success', __('translate.appointment_edited_successfully'));
    }

    public function destroy(Appointment $appointment): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->authorizeDoctorAppointment($appointment);

        $this->appointmentService->delete($appointment);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.appointment_deleted_successfully')]);
        }

        return redirect()->route('doctor.appointments.index')
            ->with('success', __('translate.appointment_deleted_successfully'));
    }

    public function data(Request $request)
    {
        $doctorId = auth('doctor')->id();
        $query = $this->appointmentService->getFilteredQuery($request, $doctorId);
        return AppointmentDataTable::make($query, $request);
    }

    private function authorizeDoctorAppointment(Appointment $appointment): void
    {
        if ($appointment->doctor_id !== auth('doctor')->id()) {
            abort(403);
        }
    }
}
