<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'details' => ['nullable', 'array'],
            'details.*.medication_id' => ['nullable', 'exists:medications,id'],
            'details.*.dosage' => ['nullable', 'string', 'max:100'],
            'details.*.frequency' => ['nullable', 'string', 'max:100'],
            'details.*.duration' => ['nullable', 'string', 'max:50'],
            'details.*.instructions' => ['nullable', 'string'],
        ];
    }
}
