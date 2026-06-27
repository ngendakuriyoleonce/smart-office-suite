<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'employee_id' => ['required', 'string', 'max:20', Rule::unique('employees')->ignore($this->route('employee'))],
            'hire_date' => ['required', 'date', 'before_or_equal:today'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'position_id' => ['nullable', 'exists:positions,id'],
            'status' => ['required', 'in:active,inactive,terminated'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('employee')->user_id)],
            'salary' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
