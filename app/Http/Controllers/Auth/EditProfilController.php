<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request; // Pastikan model User sudah ada
// Untuk hashing password
use Illuminate\Support\Facades\Auth; // Untuk autentikasi

class EditProfilController extends Controller
{
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
            'deskripsi' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portofolio' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Update data pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->deskripsi = $request->input('deskripsi');

        // Mengupload foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename); // Pastikan folder ini ada
            $user->profil_picture = $filename;
        }

        // Mengupload CV jika ada
        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $cvFilename = time().'_cv.'.$cvFile->getClientOriginalExtension();
            $cvFile->move(public_path('cvs'), $cvFilename); // Pastikan folder ini ada
            $user->CV = $cvFilename;
        }

        // Mengupload Portofolio jika ada
        if ($request->hasFile('portofolio')) {
            $portoFile = $request->file('portofolio');
            $portoFilename = time().'_porto.'.$portoFile->getClientOriginalExtension();
            $portoFile->move(public_path('portfolios'), $portoFilename); // Pastikan folder ini ada
            $user->portofolio = $portoFilename;
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman edit profil dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function index()
    {
        return view('Daftar.editp');
    }
}
