<?php  
  
namespace App\Http\Controllers\Mitra;  
  
use Illuminate\Http\Request;  
use App\Http\Controllers\Controller;  
use App\Models\Message;  
use App\Models\User;  
use App\Models\Mitra;  
use App\Models\Notification;  
use Illuminate\Support\Facades\Auth;  
  
class ChatController extends Controller  
{  
    public function index()  
    {  
        $users = User::all();  
  
        $mitra = Auth::guard('mitra')->user();  
  
        $unreadNotificationsCount = Notification::where('id_mitra', $mitra->id)    
              ->where('status', 'unread')    
              ->count();   
  
        return view('pages.mitra.chat', compact('users', 'unreadNotificationsCount'));  
    }  
  
    public function sendMessage(Request $request)  
    {  
        $request->validate([  
            'sender_id' => 'required|integer',  
            'receiver_id' => 'required|integer',  
            'message' => 'required|string',  
        ]);  
  
        try {  
            Message::create($request->all());  
            return response()->json(['success' => true]);  
        } catch (\Exception $e) {  
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);  
        }  
    }  
  
    public function getMessages($userId)  
    {  
        try {  
            $messages = Message::where(function($query) use ($userId) {  
                $query->where('receiver_id', $userId)  
                      ->orWhere('sender_id', $userId);  
            })  
            ->orderBy('created_at', 'asc')  
            ->get();  
  
            return response()->json($messages);  
        } catch (\Exception $e) {  
            return response()->json(['error' => $e->getMessage()], 500);  
        }  
    }  
}  
