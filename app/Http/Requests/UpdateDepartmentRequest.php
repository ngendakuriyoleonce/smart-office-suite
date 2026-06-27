<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('departments')->ignore($this->route('department'))],
            'code' => ['required', 'string', 'max:10', Rule::unique('departments')->ignore($this->route('department'))],
            'description' => ['nullable', 'string'],
            'manager_id' => ['nullable', 'exists:employees,id'],
        ];
    }
}
