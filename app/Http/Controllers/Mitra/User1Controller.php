<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\KerjaSama;
use App\Models\lamaran;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Notification;
use App\Models\Rating;
use App\Models\RatingUser;
use Illuminate\Support\Facades\Auth;

class User1Controller extends Controller
{
    // Menampilkan data profil mitra
    public function index()
    {
        $idMitra = Auth::guard('mitra')->user()->id;
        $mitra = Mitra::find($idMitra);
        
        // Mengambil data dari tabel kerjasama yang memiliki status 'diterima'  
        $kerjasama = KerjaSama::where('id_mitra', $idMitra)  
                                ->where('status', 'diterima')  
                                ->get();  
  
        // Mengambil data dari tabel lamarans yang memiliki status 'diterima'  
        $lamarans = lamaran::where('id_mitra', $idMitra)  
                            ->where('status', 'diterima')  
                            ->get();  
        $ratings = Rating::where('id_mitra', $idMitra)->get(); 

        $mitra = Auth::guard('mitra')->user();
        $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)  
              ->where('status', 'unread')  
              ->count(); 
            
        
        return view('pages.mitra.user', compact('mitra', 'unreadNotificationsCount' ,'ratings', 'kerjasama', 'lamarans'));
    }

    // Mengupdate profil mitra
    public function updateProfile(Request $request)
    {
        $idMitra = Auth::guard('mitra')->user()->id;
        $mitra = Mitra::find($idMitra);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mitras,email,' . $idMitra,
            'nohp' => 'required|string|max:255',
            'profil_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menyimpan file profil_picture ke folder public/images
        if ($request->hasFile('profil_picture')) {
            // Hapus foto profil lama jika ada
            if ($mitra->profil_picture) {
                @unlink(public_path('images/' . $mitra->profil_picture));
            }

            $foto = $request->file('profil_picture');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('images'), $fotoName);
            $mitra->profil_picture = $fotoName;
        }

        // Update nama dan email
        $mitra->name = $request->input('name');
        $mitra->email = $request->input('email');
        $mitra->nohp = $request->input('nohp');
        $mitra->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
