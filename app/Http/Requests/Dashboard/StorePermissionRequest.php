<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255', 'unique:permissions,name,NULL,id,guard_name,' . $this->input('guard_name', 'admin')],
            'guard_name' => ['required', 'string', 'in:admin,web'],
        ];
    }
}
