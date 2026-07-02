<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KerjaSama;
use App\Models\lamaran;
use App\Models\Notification;
use App\Models\Pekerjaan;
use App\Models\Rating;
use Illuminate\Http\Request;

class KelolaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifications = Notification::where('id_user', $user->id)  
            ->orderBy('updated_at', 'desc')  
            ->limit(3)  
            ->get(); 
        $lamarans = lamaran::with('pekerjaan')->where('id_user', auth()->id())->get();
        $kerjasama = KerjaSama::with('pekerjaan')->where('id_user', auth()->id())->get();
        return view('pages.user.kelolajob.index', compact('user','lamarans','kerjasama', 'notifications')); // Pass 'user' as a string
    }
    public function detail($id)
{
    $user = auth()->user();
    
    // Ambil data lamaran berdasarkan ID lamaran yang dikirim
    $lamaran = Lamaran::with('pekerjaan.mitra')->where('id', $id)->where('id_user', $user->id)->firstOrFail();

    // Ambil data pekerjaan dari relasi lamaran
    $pekerjaan = $lamaran->pekerjaan;

    // Ambil rating berdasarkan id pekerjaan
    $ratings = Rating::where('pekerjaan_id', $pekerjaan->id)->get();

    // Ambil notifikasi user
    $notifications = Notification::where('id_user', $user->id)
        ->orderBy('updated_at', 'desc')
        ->limit(3)
        ->get();

    return view('pages.user.kelolajob.detail', compact('user', 'lamaran', 'pekerjaan', 'notifications', 'ratings'));
}


    public function terima($id)
{
    $kerjaSama = KerjaSama::findOrFail($id);
    $kerjaSama->status = 'terima';
    $kerjaSama->save();

    Notification::create([  
        'id_user' => $kerjaSama->id_user,  
        'id_mitra' => $kerjaSama->id_mitra,  
        'isi_pesan' => 'Lamaran kerjasama Anda telah diterima.',  
        'tanggal' => $kerjaSama->updated_at,  
        'jenis' => 'Terima Kerja Sama',  
    ]);  
    return redirect()->route('user.kelolajob')->with('success', 'Lamaran kerjasama telah diterima.');
}

public function tolak($id)
{
    $kerjaSama = KerjaSama::findOrFail($id);
    $kerjaSama->status = 'tolak';
    $kerjaSama->save();

    Notification::create([  
        'id_user' => $kerjaSama->id_user,  
        'id_mitra' => $kerjaSama->id_mitra,  
        'isi_pesan' => 'Lamaran Anda Sudah Ditolak.',  
        'tanggal' => $kerjaSama->updated_at,  
        'jenis' => 'Tolak Kerja Sama',  
    ]);  
    return redirect()->route('user.kelolajob')->with('success', 'Lamaran kerjasama telah ditolak.');
}

}
