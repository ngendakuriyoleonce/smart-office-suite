<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

    #[Fillable([
        'full_name',
        'company',
        'email',
        'phone',
        'host_employee_id',
        'check_in',
        'check_out',
        'purpose',
        'badge_qr',
    ])]
    class Visitor extends Model
    {
        use HasFactory;

        public function host(): BelongsTo
        {
            return $this->belongsTo(Employee::class, 'host_employee_id');
        }

        protected function casts(): array
        {
            return [
                'check_in' => 'datetime',
                'check_out' => 'datetime',
            ];
        }
    }
