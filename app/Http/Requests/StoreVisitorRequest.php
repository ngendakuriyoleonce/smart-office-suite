<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:100'],
            'company' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'host_employee_id' => ['required', 'exists:employees,id'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'check_in' => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }
}
