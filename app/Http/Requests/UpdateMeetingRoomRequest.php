<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMeetingRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('meeting_rooms')->ignore($this->route('meeting_room'))],
            'capacity' => ['required', 'integer', 'min:1'],
            'amenities' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
