<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mitra',
        'nama_lowongan',
        'jenis_lowongan',
        'gaji_minimal',
        'gaji_maksimal',
        'deskripsi',
        'persyaratan',
        'lokasi',
        'foto',
        'status',
    ];

    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'id_pekerjaan');
    }
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }
}

