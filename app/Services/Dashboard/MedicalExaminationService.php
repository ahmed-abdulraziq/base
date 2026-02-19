<?php

namespace App\Services\Dashboard;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\MedicalExamination;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MedicalExaminationService
{
    public function getFilteredQuery(Request $request, ?int $doctorId = null): Builder
    {
        $query = MedicalExamination::query()->with(['patient', 'doctor', 'appointment']);

        if ($doctorId !== null) {
            $query->where('doctor_id', $doctorId);
        }

        if ($request->filled('filter_search')) {
            $term = $request->filter_search;
            $query->where(function ($q) use ($term) {
                $q->whereHas('patient', fn ($p) => $p->where('name', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%"))
                    ->orWhereHas('doctor', fn ($d) => $d->where('name', 'like', "%{$term}%"))
                    ->orWhere('diagnosis', 'like', "%{$term}%")
                    ->orWhere('symptoms', 'like', "%{$term}%");
            });
        }
        if ($request->filled('filter_doctor')) {
            $query->where('doctor_id', $request->filter_doctor);
        }
        if ($request->filled('filter_patient')) {
            $query->where('patient_id', $request->filter_patient);
        }
        if ($request->filled('filter_date_from')) {
            $query->whereDate('examination_date', '>=', $request->filter_date_from);
        }
        if ($request->filled('filter_date_to')) {
            $query->whereDate('examination_date', '<=', $request->filter_date_to);
        }

        return $query;
    }

    public function getCreateFormOptions(?int $doctorId = null): array
    {
        $appointmentsQuery = Appointment::with(['patient', 'doctor'])
            ->orderBy('appointment_date', 'desc');
        if ($doctorId !== null) {
            $appointmentsQuery->where('doctor_id', $doctorId)
                ->whereIn('status', [AppointmentStatus::Confirmed->value, AppointmentStatus::Booked->value]);
        } else {
            $appointmentsQuery->whereIn('status', [AppointmentStatus::Confirmed->value, AppointmentStatus::Booked->value]);
        }
        $appointments = $appointmentsQuery->get()
            ->mapWithKeys(fn ($a) => [$a->id => "موعد #{$a->id} - {$a->patient?->full_name} - {$a->doctor?->full_name} - {$a->appointment_date?->format('Y-m-d')}"])
            ->toArray();

        $patients = Patient::orderBy('name')->get()->pluck('full_name', 'id')->toArray();
        $doctors = Doctor::active()->get()->pluck('full_name', 'id')->toArray();

        if ($doctorId !== null) {
            $doctors = [];
        }

        return compact('appointments', 'patients', 'doctors');
    }

    public function create(array $data, ?int $doctorId = null): MedicalExamination
    {
        if ($doctorId !== null) {
            $appointment = Appointment::where('doctor_id', $doctorId)->findOrFail($data['appointment_id']);
            $data['appointment_id'] = $appointment->id;
            $data['patient_id'] = $appointment->patient_id;
            $data['doctor_id'] = $appointment->doctor_id;
        }
        return MedicalExamination::create($data);
    }

    public function update(MedicalExamination $examination, array $data): bool
    {
        return $examination->update($data);
    }

    public function delete(MedicalExamination $examination): bool
    {
        return $examination->delete();
    }

    public function getDoctorOptionsForFilter(): array
    {
        return Doctor::active()->get()->pluck('full_name', 'id')->toArray();
    }

    public function getPatientOptionsForFilter(): array
    {
        return Patient::orderBy('name')->get()->pluck('full_name', 'id')->toArray();
    }
}
