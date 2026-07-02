<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjaSama extends Model
{
    use HasFactory;

    protected $table = 'kerjasama';

    protected $fillable = [
        'id_user',
        'id_mitra',
        'id_pekerjaan',
        'status',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
