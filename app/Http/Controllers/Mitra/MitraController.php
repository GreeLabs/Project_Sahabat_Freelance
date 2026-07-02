<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Notification;
use App\Models\Pekerjaan;
use App\Models\lamaran;
use App\Models\Rating;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    public function index() {
        $contents = Content::all();
        $mitra = Auth::guard('mitra')->user();
        
        $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)  
              ->where('status', 'unread')  
              ->count(); 

        $totalJobs = Pekerjaan::where('id_mitra', $mitra->id)->count();
        $totalLamaran = lamaran::whereHas('pekerjaan', function($q) use ($mitra) {
            $q->where('id_mitra', $mitra->id);
        })->count();
        
        $avgRating = Rating::where('id_mitra', $mitra->id)->avg('rating') ?? 0;
        
        $unreadMessages = Message::where('receiver_id', 'mitra_' . $mitra->id)
                                 ->where('is_read', false)
                                 ->count();

        // Recent activity (Last 5 Lamaran)
        $recentLamaran = lamaran::with(['user', 'pekerjaan'])
            ->whereHas('pekerjaan', function($q) use ($mitra) {
                $q->where('id_mitra', $mitra->id);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('pages.mitra.index', compact(
            'contents', 
            'unreadNotificationsCount', 
            'totalJobs', 
            'totalLamaran', 
            'avgRating', 
            'unreadMessages',
            'recentLamaran'
        ));
    }
}
