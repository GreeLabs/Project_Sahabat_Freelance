<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::paginate(5, ['*'], 'users_page');
        $mitras = Mitra::paginate(5, ['*'], 'mitras_page');
        return view('pages.admin.pengguna.index', compact('users', 'mitras'));
    }

    public function suspendUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'suspended';
        $user->save();

        return redirect()->route('admin.pengguna')->with('success', 'User suspended successfully.');
    }

    public function suspendMitra($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->status = 'suspended';
        $mitra->save();

        return redirect()->route('admin.pengguna')->with('success', 'Mitra suspended successfully.');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:aktif,suspended',
            
            'cv' => 'nullable|file|mimes:pdf',
            'description' => 'nullable|string|max:255',
            'portfolio' => 'nullable|file|mimes:pdf',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;

        if ($request->hasFile('cv')) {
            // Simpan CV dan update path di database
            $user->cv = $request->file('cv')->store('cvs');
        }

        if ($request->hasFile('portfolio')) {
            // Simpan portofolio dan update path di database
            $user->portfolio = $request->file('portfolio')->store('portfolios');
        }

        $user->description = $request->description;
        $user->save();

        return redirect()->route('admin.pengguna')->with('success', 'User updated successfully.');
    }

    public function updateMitra(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:aktif,suspended',
            'role' => 'required|in:basic,premium',
        ]);

        $mitra = Mitra::findOrFail($id);
        $mitra->name = $request->name;
        $mitra->email = $request->email;
        $mitra->status = $request->status;
        $mitra->role = $request->role;

        $mitra->save();

        return redirect()->route('admin.pengguna')->with('success', 'Mitra updated successfully.');
    }
}
