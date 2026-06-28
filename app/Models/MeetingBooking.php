<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'room_id',
    'booked_by',
    'title',
    'start_time',
    'end_time',
    'description',
    'status',
])]
class MeetingBooking extends Model
{
    use HasFactory;

    public function room(): BelongsTo
    {
        return $this->belongsTo(MeetingRoom::class, 'room_id');
    }

    public function bookedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'booked_by');
    }

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }
}
