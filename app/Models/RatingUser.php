<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingUser extends Model
{
    use HasFactory;

    protected $table = 'rating_users';
    protected $fillable = [
        'id_mitra',
        'id_user',
        'rating',
        'komentar',
        'tag'
    ];
}
