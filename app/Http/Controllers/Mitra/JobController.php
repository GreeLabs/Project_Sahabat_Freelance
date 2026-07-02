<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use App\Models\Mitra;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JobController extends Controller
{
    /* ======================================================================================== */
/* Name of the organization          : PT Freelance Indonesia                               */
/* Program ID/Name                   : JobController.php                                    */
/* Original author                   : Software Development Team                            */
/* Original creation date            : 2024-01-15                                           */
/* Parameter list                    : Request $request, int $id                            */
/* Program explanation               : Mengelola semua proses CRUD untuk lowongan pekerjaan */
/* IPR rights belong to              : PT Freelance Indonesia                               */
/* ======================================================================================== */

/* ========================= */
/* Revision history          */
/***************************************************************/
/* Programmer     Date         Description of modification     */
/***************************************************************/
/* Sahrul         2025-06-21   Menambahkan dokumentasi standar */
/* Sahrul         2025-06-21   Refactor kode dan komentar loop */
/***************************************************************/

    /* =============================== 
       Menampilkan Daftar Lowongan 
    =============================== */
    public function index()
    {
        // Ambil ID mitra yang sedang login
        $idMitra = Auth::guard('mitra')->user()->id;

        // Query untuk mendapatkan data sesuai dengan id_mitra yang login
        $data = Pekerjaan::where('id_mitra', $idMitra)->get();


        $mitra = Auth::guard('mitra')->user();
        /* ================================================================ */
        /* Purpose         = Menghitung notifikasi yang belum dibaca       */
        /* Entry condition = ID mitra aktif                                */
        /* Exit condition  = Jumlah notifikasi unread                      */
        /* ================================================================ */
        $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)
            ->where('status', 'unread')
            ->count();

        // Menampilkan data dalam view
        return view('pages.mitra.job', compact('data', 'unreadNotificationsCount'));
    }

    /* =============================== 
       Tampilkan Form Tambah Lowongan 
    =============================== */
    public function create()
    {
        return view('pages.mitra.job.create');
    }

    /* ===============================
       Simpan Lowongan Baru
    =============================== */
    public function store(Request $request)
    {
        // Ambil data mitra yang sedang login
        $mitra = Auth::guard('mitra')->user();

        // Validasi kuota untuk mitra basic
        if ($mitra->role === 'basic' && $mitra->quota_posted_jobs <= 0) {
            Alert::html('Kuota Habis',
                'Anda telah mencapai batas maksimum lowongan. <br> <a href="' . route('mitra.dashboard') . '" class="btn btn-primary">Update ke Premium</a>',
                'warning'
            );
            return redirect()->back();
        }

        // Validasi input
        $request->validate([
            'nama_lowongan'   => 'required',
            'jenis_lowongan'  => 'required',
            'gaji_minimal'    => 'required|numeric',
            'gaji_maksimal'   => 'required|numeric',
            'deskripsi'       => 'required',
            'persyaratan'     => 'required',
            'lokasi'          => 'required',
            'foto'            => 'required|mimes:png,jpeg,jpg',
        ]);

        // Upload foto
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move('images/', $fotoName);
        }

        // Simpan data lowongan
        $pekerjaan = Pekerjaan::create([
            'id_mitra'       => $mitra->id,
            'nama_lowongan'  => $request->nama_lowongan,
            'jenis_lowongan' => $request->jenis_lowongan,
            'gaji_minimal'   => $request->gaji_minimal,
            'gaji_maksimal'  => $request->gaji_maksimal,
            'deskripsi'      => $request->deskripsi,
            'persyaratan'    => $request->persyaratan,
            'lokasi'         => $request->lokasi,
            'foto'           => $fotoName,
        ]);

        if ($pekerjaan) {
            // Kurangi kuota untuk mitra basic
            if ($mitra->role === 'basic') {
                $mitra->quota_posted_jobs -= 1;
                $mitra->save();
            }

            Alert::success('Berhasil!', 'Lowongan berhasil ditambahkan!');
            return redirect()->route('mitra.job');
        } else {
            Alert::error('Gagal!', 'Lowongan gagal ditambahkan!');
            return redirect()->back();
        }
    }

    /* ===============================
       Detail Lowongan
    =============================== */
    public function detail($id)
    {
        $pekerjaan = Pekerjaan::with('mitra')->findOrFail($id);
        $mitra = Auth::guard('mitra')->user();
        $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)
            ->where('status', 'unread')
            ->count();

        return view('pages.mitra.detailjob', compact('pekerjaan', 'unreadNotificationsCount'));
    }

    /* ===============================
       Edit Lowongan
    =============================== */
    public function edit($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        return view('pages.mitra.editjob', compact('pekerjaan'));
    }

    /* ===============================
       Update Lowongan
    =============================== */
    public function update(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info('Update function called', ['id' => $id, 'request' => $request->all()]);

        // Validasi input
        $request->validate([
            'nama_lowongan'   => 'required|string|max:255',
            'jenis_lowongan'  => 'required|string',
            'gaji_minimal'    => 'required|numeric',
            'gaji_maksimal'   => 'required|numeric',
            'deskripsi'       => 'required|string',
            'persyaratan'     => 'nullable|string',
            'lokasi'          => 'required|string',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->nama_lowongan   = $request->nama_lowongan;
        $pekerjaan->jenis_lowongan  = $request->jenis_lowongan;
        $pekerjaan->gaji_minimal    = $request->gaji_minimal;
        $pekerjaan->gaji_maksimal   = $request->gaji_maksimal;
        $pekerjaan->deskripsi       = $request->deskripsi;
        $pekerjaan->persyaratan     = $request->persyaratan;
        $pekerjaan->lokasi          = $request->lokasi;

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $pekerjaan->foto = $imageName;
        }

        // Simpan data
        try {
            if ($pekerjaan->save()) {
                \Illuminate\Support\Facades\Log::info('Job updated successfully', ['id' => $pekerjaan->id]);
                Alert::success('Berhasil!', 'Lowongan berhasil diperbarui!');
            } else {
                \Illuminate\Support\Facades\Log::error('Failed to update job', ['id' => $pekerjaan->id]);
                Alert::error('Gagal!', 'Lowongan gagal diperbarui!');
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating job: ' . $e->getMessage());
            Alert::error('Gagal!', 'Terjadi kesalahan saat memperbarui lowongan.');
        }

        return redirect()->route('mitra.job');
    }

    /* ===============================
       Nonaktifkan Lowongan
    =============================== */
    public function deactivate($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->status = 'tidak_aktif';

        // Simpan status nonaktif
        if ($pekerjaan->save()) {
            Alert::success('Berhasil!', 'Lowongan berhasil dinonaktifkan.');
        } else {
            Alert::error('Gagal!', 'Lowongan gagal dinonaktifkan.');
        }

        return redirect()->route('mitra.job');
    }
}
