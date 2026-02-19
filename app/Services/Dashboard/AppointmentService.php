<?php

namespace App\Services\Dashboard;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AppointmentService
{
    public function getFilteredQuery(Request $request, ?int $doctorId = null): Builder
    {
        $query = Appointment::query()->with(['patient', 'doctor', 'doctor.specialization']);

        if ($doctorId !== null) {
            $query->where('doctor_id', $doctorId);
        }

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->whereHas('patient', fn ($p) => $p->where('name', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%"))
                    ->orWhereHas('doctor', fn ($d) => $d->where('name', 'like', "%{$term}%"));
            });
        }
        if ($request->filled('filter_doctor')) {
            $query->where('doctor_id', $request->filter_doctor);
        }
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('appointment_date', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('appointment_date', '<=', $request->filter_date_to);
        }

        return $query;
    }

    public function getCreateFormOptions(?int $doctorId = null): array
    {
        $patients = Patient::orderBy('name')->get()->pluck('full_name', 'id')->toArray();
        $doctors = Doctor::active()->get()->pluck('full_name', 'id')->toArray();
        $employees = Employee::active()->get()->pluck('full_name', 'id')->toArray();

        if ($doctorId !== null) {
            $employees = Employee::where('doctor_id', $doctorId)->whereNotNull('approved_at')
                ->orderBy('name')->get()->pluck('full_name', 'id')->toArray();
            $doctors = [];
        }

        return compact('patients', 'doctors', 'employees');
    }

    public function create(array $data, ?int $doctorId = null): Appointment
    {
        if ($doctorId !== null) {
            $data['doctor_id'] = $doctorId;
            $data['created_by'] = $data['created_by'] ?? null;
        }
        return Appointment::create($data);
    }

    public function update(Appointment $appointment, array $data, ?int $doctorId = null): bool
    {
        if ($doctorId !== null) {
            $data['doctor_id'] = $doctorId;
            $data['created_by'] = $data['created_by'] ?? null;
        }
        return $appointment->update($data);
    }

    public function delete(Appointment $appointment): bool
    {
        return $appointment->delete();
    }

    public function getDoctorOptionsForFilter(): array
    {
        return Doctor::active()->get()->pluck('full_name', 'id')->toArray();
    }
}
