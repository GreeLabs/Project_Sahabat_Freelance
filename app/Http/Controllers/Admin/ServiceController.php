<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\Service; // Pastikan untuk mengimpor model Service
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Ambil semua layanan dari database
        $services = Service::all();
        $premiumUsers = User::where('role', 'premium')->get();  
        $premiumMitras = Mitra::where('role', 'premium')->get();  
        return view('pages.admin.layanan.index', compact('services','premiumUsers','premiumMitras'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Simpan layanan baru
        Service::create($request->all());

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Temukan layanan dan perbarui
        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan layanan dan hapus
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus.');
    }
}
