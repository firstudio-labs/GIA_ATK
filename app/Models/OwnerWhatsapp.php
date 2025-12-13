<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerWhatsapp extends Model
{
    use HasFactory;
    protected $fillable = ['no_wa', 'template_pesan'];
    protected $table = 'owner_whatsapps';
}
