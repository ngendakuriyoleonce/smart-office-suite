<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('departments')],
            'code' => ['required', 'string', 'max:10', Rule::unique('departments')],
            'description' => ['nullable', 'string'],
            'manager_id' => ['nullable', 'exists:employees,id'],
        ];
    }
}
