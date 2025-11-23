<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageArtikel extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'isi',
        'slug',
        'status',
    ];
}
