<?php

namespace App\Http\Requests\Dashboard\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type' => ['required', 'in:doctor,patient'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email'],
        ];

        if ($this->input('type') === 'doctor') {
            $rules['email'][] = 'unique:doctors,email';
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string', 'min:8'];
            $rules['license_number'] = ['required', 'string', 'max:50', 'unique:doctors,license_number'];
            $rules['specialization_id'] = ['nullable', 'exists:specializations,id'];
            $rules['years_of_experience'] = ['nullable', 'integer', 'min:0', 'max:70'];
        }

        if ($this->input('type') === 'patient') {
            $rules['email'][] = 'unique:patients,email';
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string', 'min:8'];
            $rules['date_of_birth'] = ['required', 'date', 'before:today'];
            $rules['gender'] = ['required', 'in:male,female'];
            $rules['address'] = ['nullable', 'string', 'max:500'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.unique' => __('translate.email_already_registered'),
            'license_number.unique' => __('translate.license_number_already_registered'),
        ];
    }
}
