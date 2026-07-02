<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Notification extends Model  
{  
    use HasFactory;  
  
    protected $fillable = [  
        'id_user',  
        'id_mitra',  
        'isi_pesan',  
        'tanggal',  
        'jenis',  
        'status',
        'updated_at'
    ];  
    public function user()  
    {  
        return $this->belongsTo(User::class, 'id_user');  
    }  
  
    public function mitra()  
    {  
        return $this->belongsTo(Mitra::class, 'id_mitra');  
    }  
}  
