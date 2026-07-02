<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamarans';

    protected $fillable = [
        'id_pekerjaan',
        'id_user',
        'id_mitra',
        'status',
        'deskripsiU'
    ];

    /**
     * Relasi ke model Pekerjaan.
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan');
    }
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
