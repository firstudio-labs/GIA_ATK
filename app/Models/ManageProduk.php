<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageProduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'judul',
        'kategori_id',
        'sub_kategori_id',
        'gambar_produk',
        'harga',
        'diskon',
        'sku',
        'deskripsi',
        'status',
        'berat',
        'ukuran',
        'warna',
    ];

    protected $casts = [
        'gambar_produk' => 'array',
        'harga' => 'decimal:2',
        'diskon' => 'integer',
        'berat' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(ManageKategori::class, 'kategori_id');
    }

    public function subKategori()
    {
        return $this->belongsTo(ManageSubKategori::class, 'sub_kategori_id');
    }
}
