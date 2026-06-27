<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePositionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:10', Rule::unique('positions')->ignore($this->route('position'))],
            'description' => ['nullable', 'string'],
        ];
    }
}
