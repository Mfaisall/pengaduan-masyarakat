<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    
    //nentuin data mana aja yang akan diisi sama user 
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'no_telp',
        'pengaduan',
        'foto',
    ];
}
