<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'asset_tag',
    'name',
    'category',
    'brand',
    'model',
    'serial_number',
    'purchase_price',
    'purchase_date',
    'status',
    'description',
])]
class Asset extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'purchase_price' => 'decimal:2',
            'purchase_date' => 'date',
        ];
    }
}
