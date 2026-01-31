<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $permission = $this->route('permission');

        return [
            'name'       => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id . ',id,guard_name,' . $this->input('guard_name', $permission->guard_name)],
            'guard_name' => ['required', 'string', 'in:admin,web'],
        ];
    }
}
