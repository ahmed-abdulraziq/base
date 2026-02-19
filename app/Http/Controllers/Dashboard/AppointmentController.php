<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAppointmentRequest;
use App\Http\Requests\Dashboard\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\DataTables\Dashboard\AppointmentDataTable;
use App\Services\Dashboard\AppointmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentService $appointmentService
    ) {
        $this->middleware('can:view.appointments')->only(['index', 'data', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request): View
    {
        $route = 'clinic.appointments.data';
        $doctorOptions = $this->appointmentService->getDoctorOptionsForFilter();
        return view('dashboard.clinic.appointments.index', compact('route', 'doctorOptions'));
    }

    public function data(Request $request)
    {
        $query = $this->appointmentService->getFilteredQuery($request);
        return AppointmentDataTable::make($query, $request);
    }

    public function create(): View
    {
        $options = $this->appointmentService->getCreateFormOptions();
        return view('dashboard.clinic.appointments.create', $options);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $this->appointmentService->create($request->validated());
        return redirect()->route('dashboard.clinic.appointments.index')
            ->with('success', __('translate.appointment_added_successfully'));
    }

    public function edit(Appointment $appointment): View
    {
        $options = $this->appointmentService->getCreateFormOptions();
        return view('dashboard.clinic.appointments.edit', compact('appointment') + $options);
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $this->appointmentService->update($appointment, $request->validated());
        return redirect()->route('dashboard.clinic.appointments.index')
            ->with('success', __('translate.appointment_edited_successfully'));
    }

    public function destroy(Appointment $appointment): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $this->appointmentService->delete($appointment);
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['status' => true, 'message' => __('translate.appointment_deleted_successfully')]);
        }
        return redirect()->route('dashboard.clinic.appointments.index')
            ->with('success', __('translate.appointment_deleted_successfully'));
    }
}
