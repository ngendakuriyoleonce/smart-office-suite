<?php

namespace App\Http\Requests;

use App\OpenCodeAI;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $result = OpenCodeAI::analyzeVisitorRisk(
                $this->full_name,
                $this->company
            );

            if ($result['risk'] === 'high') {
                $validator->errors()->add(
                    'full_name',
                    'Visitor verification failed. Your request requires manual review.'
                );
            }
        });
    }
}
