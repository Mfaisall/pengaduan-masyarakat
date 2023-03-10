<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengaduan;

class Respon extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaduan_id',
        'status',
        'pesan',
    ];

    // belongTo : disambungkan dengan table nama (PK nya ada dimana)
    // table yang berperan sebagai FK 
    // nama fungsi == nama model FK
    public function pengaduan()
    {
        return $this->belongsTo
        (Pengaduan::class);
    }
}
