<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LowonganController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel lamaran dengan join
        $lamarans = DB::table('lamarans')
            ->join('pekerjaans', 'lamarans.id_pekerjaan', '=', 'pekerjaans.id') // Ganti 'pekerjaan_id' dengan nama kolom yang sesuai
            ->join('users', 'lamarans.id_user', '=', 'users.id') // Ganti 'user_id' dengan nama kolom yang sesuai
            ->select('lamarans.*', 'pekerjaans.nama_lowongan', 'users.name as name')
            ->get();

        return view('pages.admin.lowongan.index', compact('lamarans'));
    }
    public function detail($id)
{
    // Ambil data detail berdasarkan ID
    $lamaran = DB::table('lamarans')
        ->join('pekerjaans', 'lamarans.id_pekerjaan', '=', 'pekerjaans.id')
        ->join('users', 'lamarans.id_user', '=', 'users.id')
        ->where('lamarans.id', $id)
        ->select(
            'lamarans.*',
            'pekerjaans.nama_lowongan',
            'pekerjaans.deskripsi',
            'pekerjaans.lokasi',
            'pekerjaans.gaji_minimal',
            'pekerjaans.gaji_maksimal',
            'users.name as freelancer_name',
            'users.email'
        )
        ->first();

    if (!$lamaran) {
        return redirect()->route('admin.lowongan.index')->with('error', 'Data tidak ditemukan');
    }

    return view('pages.admin.lowongan.detail', compact('lamaran'));
}



}
