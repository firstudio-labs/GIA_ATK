<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_layanan',
        'deskripsi_layanan',
        'gambar_layanan',
        'faq',
    ];
    protected $casts = [
        'gambar_layanan' => 'string',
        'faq' => 'array',
    ];
}