<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert; 

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('pages.admin.konten.index', compact('contents'));
    }
    public function edit($id)
{
    // Ambil data konten berdasarkan ID
    $content = Content::findOrFail($id);
    // Kirim data ke view untuk ditampilkan di form edit
    return view('pages.admin.konten.edit', compact('content'));
}

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'button_name' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $content = Content::findOrFail($id);
    $content->title = $request->title;
    $content->button_name = $request->button_name;
    $content->body = $request->body;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Remove the old image
        if ($content->image && file_exists(public_path('images/' . $content->image))) {
            unlink(public_path('images/' . $content->image));
        }
        $content->image = $imageName;
    }

    $content->save();

    return redirect()->route('admin.konten')->with('success', 'Konten berhasil diperbarui!');
}

     
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'button_name' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
    }

    $content = Content::create([
        'title' => $request->title,
        'button_name' => $request->button_name,
        'body' => $request->body,
        'image' => $imageName,
    ]);

    if ($content) {
        Alert::success('Berhasil!', 'Konten berhasil ditambahkan!');
        return redirect()->route('admin.konten');
    } else {
        Alert::error('Gagal!', 'Konten gagal ditambahkan!');
        return redirect()->back();
    }
}

public function destroy($id)
{
    // Cari konten berdasarkan ID
    $content = Content::findOrFail($id);

    // Hapus gambar jika ada
    if ($content->image && file_exists(public_path('images/' . $content->image))) {
        unlink(public_path('images/' . $content->image));
    }

    
    // Hapus data konten dari database
    $content->delete();

    return redirect()->route('admin.konten')->with('success', 'Konten berhasil dihapus!');
}

    
}
