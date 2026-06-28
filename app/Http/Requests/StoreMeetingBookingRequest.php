<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreMeetingBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:meeting_rooms,id',
            'title' => 'required|string|max:150',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $overlap = \App\Models\MeetingBooking::where('room_id', $this->room_id)
                ->where('status', '!=', 'cancelled')
                ->where(function ($q) {
                    $q->whereBetween('start_time', [$this->start_time, $this->end_time])
                        ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                        ->orWhere(function ($q2) {
                            $q2->where('start_time', '<=', $this->start_time)
                                ->where('end_time', '>=', $this->end_time);
                        });
                })->exists();

            if ($overlap) {
                $validator->errors()->add('start_time', 'Room already booked for this time slot.');
            }
        });
    }
}
