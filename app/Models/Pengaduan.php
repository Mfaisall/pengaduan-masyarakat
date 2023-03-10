<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respon;


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

    //hasOne : one to one 
    // table yang berperan sebagai PK
    // nama fungsi == nama modek FK
    public function respon()
    {
        return $this->hasOne
        (Respon::class);
    }
}
