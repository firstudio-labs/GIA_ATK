<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_ids',
        'discount_percentage',
        'is_new',
    ];

    protected $casts = [
        'product_ids' => 'array',
        'discount_percentage' => 'integer',
        'is_new' => 'boolean',
    ];
}
