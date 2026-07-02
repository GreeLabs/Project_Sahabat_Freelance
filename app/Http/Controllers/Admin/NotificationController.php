<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;  
use App\Models\Mitra;  
use App\Models\Notification;
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller  
{  
public function create()
{
    $notifications = DB::table('notifications')
        ->leftJoin('users', 'notifications.id_user', '=', 'users.id')
        ->leftJoin('mitras', 'notifications.id_mitra', '=', 'mitras.id')
        ->select(
            'notifications.*',
            'users.name as user_name',
            'mitras.name as mitra_name'
        )
        ->get();

    return view('pages.admin.Notifikasi', compact('notifications'));
}

  
    public function store(Request $request)  
    {  
        $request->validate([  
            'id_user' => 'nullable|exists:users,id',  
            'id_mitra' => 'nullable|exists:mitras,id',  
            'isi_pesan' => 'required|string',  
            'tanggal' => 'required|date',  
            'jenis' => 'required|string',  
        ]);  
  
        Notification::create([  
            'id_user' => $request->id_user,  
            'id_mitra' => $request->id_mitra,  
            'isi_pesan' => $request->isi_pesan,  
            'tanggal' => $request->tanggal,  
            'jenis' => $request->jenis,  
            'status' => 'unread',  
        ]);  
  
        return redirect()->route('admin.notifikasi')->with('success', 'Notifikasi berhasil ditambahkan.');  
    }  
}  