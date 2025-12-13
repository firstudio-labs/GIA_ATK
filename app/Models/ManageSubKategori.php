<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSubKategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_nama_sub_kategori',
        'second_nama_sub_kategori',
        'kategori_id',
    ];
    public function kategori()
    {
        return $this->belongsTo(ManageKategori::class, 'kategori_id');
    }
}
