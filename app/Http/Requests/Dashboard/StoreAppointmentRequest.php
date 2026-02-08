<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'created_by' => $this->created_by ?: null,
        ]);
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:patients,patient_id'],
            'doctor_id' => ['required', 'exists:doctors,doctor_id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'status' => ['required', 'in:محجوز,مؤكد,منتهي,ملغي'],
            'reason' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'created_by' => ['nullable', 'exists:employees,employee_id'],
        ];
    }
}
