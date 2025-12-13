<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe',
        'judul',
        'deskripsi',
        'gambar',
        'status',
    ];
}
