<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'google_id',
        'email',
        'nohp',
        'keahlian',
        'password',
        'profil_picture',
        'CV',
        'portofolio',
        'deskripsi'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function messagesSent()  
    {  
        return $this->hasMany(Message::class, 'sender_id');  
    }  
  
    public function messagesReceived()  
    {  
        return $this->hasMany(Message::class, 'receiver_id');  
    }  
    public function notifications()  
    {  
        return $this->hasMany(Notification::class, 'id_user');  
    }  
}
