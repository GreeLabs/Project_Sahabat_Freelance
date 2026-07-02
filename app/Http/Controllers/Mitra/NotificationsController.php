<?php  
 namespace App\Http\Controllers\Mitra;  
  
 use App\Events\NotificationSent;  
 use App\Http\Controllers\Controller;  
 use App\Models\Notification;  
 use Illuminate\Support\Facades\Auth;  
 use Illuminate\Http\Request;  
   
 class NotificationsController extends Controller  
 {  
     public function index()  
     {  
         // Pastikan hanya mitra yang login yang dapat mengakses fungsi ini  
         if (!Auth::guard('mitra')->check()) {  
             return redirect()->route('mitra.login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');  
         }  
   
         // Ambil mitra yang login  
         $mitra = Auth::guard('mitra')->user();  
   
         // Ambil data notifikasi untuk mitra yang login dan urutkan berdasarkan updated_at  
         $notifications = Notification::where('id_mitra', $mitra->id)  
             ->orderBy('updated_at', 'desc')  
             ->get();  
   
         // Hitung jumlah notifikasi yang belum dibaca  
         $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)  
             ->where('status', 'unread')  
             ->count();  
   
         // Kirim data notifikasi dan jumlah notifikasi yang belum dibaca ke view  
         return view('pages.mitra.notifications', compact('notifications', 'unreadNotificationsCount'));  
     }  
   
     public function markAsRead($id)  
     {  
         $notification = Notification::find($id);  
         if ($notification) {  
             $notification->status = 'read';  
             $notification->save();  
   
             // Kirim event dengan detail notifikasi  
             event(new NotificationSent($notification));  
   
             return response()->json(['success' => true]);  
         }  
   
         return response()->json(['success' => false]);  
     }  
   
     public function addNotification(Request $request)  
     {  
         $mitra = Auth::guard('mitra')->user();  
         $notification = new Notification();  
         $notification->id_mitra = $mitra->id;  
         $notification->id_user = $request->input('id_user', 0);  
         $notification->isi_pesan = $request->input('message');  
         $notification->tanggal = now();  
         $notification->jenis = $request->input('jenis', 'Umum');  
         $notification->status = 'unread';  
         $notification->save();  
   
         // Kirim event dengan detail notifikasi  
         event(new NotificationSent($notification));  
   
         return response()->json(['success' => true]);  
     }  
 }