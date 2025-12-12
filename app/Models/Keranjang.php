<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    
    protected $table = 'keranjangs';
    
    protected $fillable = [
        'user_id',
        'produk_id',
        'quantity',
        'harga',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function produk()
    {
        return $this->belongsTo(ManageProduk::class, 'produk_id');
    }
}
