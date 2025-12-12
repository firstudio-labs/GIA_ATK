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
        'model',
        'tags',
        'gambar_produk',
        'harga',
        'diskon',
        'sku',
        'deskripsi',
        'detail_produk',
        'status',
        'berat',
        'ukuran',
        'warna',
    ];

    protected $casts = [
        'model' => 'array',
        'tags' => 'array',
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

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'produk_id');
    }
}
