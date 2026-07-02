<?php

namespace App\Http\Controllers\Mitra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lamaran; // Model untuk tabel lamaran
use App\Models\Notification;
use App\Models\User; // Model untuk tabel users
use App\Models\Pekerjaan; // Model untuk tabel pekerjaan
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;// Untuk mendapatkan informasi pengguna yang sedang login

class LamarController extends Controller
{
    // Fungsi untuk menampilkan daftar lamaran
    public function index()
    {
        // Ambil ID mitra yang sedang login
    $mitra = Auth::guard('mitra')->user();

    // Ambil data lamaran dengan join tabel pekerjaans dan users, serta filter berdasarkan id_mitra
    $lamarans = DB::table('lamarans')
        ->join('pekerjaans', 'lamarans.id_pekerjaan', '=', 'pekerjaans.id') // Ganti 'pekerjaan_id' dengan nama kolom yang sesuai
        ->join('users', 'lamarans.id_user', '=', 'users.id') 
        ->join('mitras', 'lamarans.id_mitra', '=', 'mitras.id') // Ganti 'user_id' dengan nama kolom yang sesuai
        ->select('lamarans.*', 'pekerjaans.nama_lowongan', 'users.name as name', 'users.*', 'pekerjaans.*')
        ->where('lamarans.id_mitra', $mitra->id) // Tambahkan kondisi filter berdasarkan id_mitra
        ->get();

        $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)  
              ->where('status', 'unread')  
              ->count(); 

    return view('pages.mitra.lamar', compact('lamarans','unreadNotificationsCount'));
    }

    // Fungsi untuk mengubah status lamaran
    public function updateStatus(Request $request, $id)
{
    $lamaran = Lamaran::findOrFail($id); // Temukan lamaran berdasarkan ID

    // Validasi input
    $request->validate([
        'status' => 'required|in:diterima,ditolak', // Pastikan status valid
    ]);

    // Ubah status lamaran
    $lamaran->status = $request->status;
    $lamaran->save();

    return redirect()->route('mitra.lamar')->with('success', 'Status lamaran berhasil diubah.');
}

}
