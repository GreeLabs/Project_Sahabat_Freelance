<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Notification;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $pekerjaans = Pekerjaan::where('status', 'aktif')->get();
        $Pekerjaan = Pekerjaan::count();
        $contents = Content::all();
        $user = auth()->user();
        $notifications = Notification::where('id_user', $user->id)  
            ->orderBy('updated_at', 'desc')  
            ->limit(3)  
            ->get();   
        return view('pages.user.index', compact('Pekerjaan','user', 'pekerjaans','contents','notifications')); // Pass 'user' as a string
    }
    public function Ketentuan()
    {
        $user = auth()->user();
        $notifications = Notification::where('id_user', $user->id)  
            ->orderBy('updated_at', 'desc')  
            ->limit(3)  
            ->get(); 
        return view('pages.user.ketentuan', compact('user', 'notifications')); // Pass 'user' as a string
    }
    
}
