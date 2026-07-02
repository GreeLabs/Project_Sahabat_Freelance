<?php  
  
namespace App\Http\Controllers\User;  
  
use Illuminate\Http\Request;  
use App\Http\Controllers\Controller;  
use App\Models\Notification;  
use Illuminate\Support\Facades\Auth;  
use App\Models\User; // Make sure to import your User model  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\Storage;  
  
class EditProfilController extends Controller  
{  
    // Display the user profile  
    public function edit()  
    {  
        $user = Auth::user(); // Get the currently authenticated user  
        $notifications = Notification::where('id_user', $user->id)    
            ->orderBy('updated_at', 'desc')    
            ->limit(3)    
            ->get();   
        return view('pages.user.editprofil', compact('user', 'notifications')); // Pass the user data to the view  
    }  
  
    // Update the user profile  
    public function update(Request $request)      
    {      
        $user = Auth::user(); // Get the currently authenticated user      
          
        // Validate the incoming request data      
        $request->validate([      
            'username' => 'required|string|max:255',      
            'email' => 'required|email|max:255',      
            'nohp' => 'nullable|string|max:20',      
            'keahlian' => 'nullable|string|max:255',      
            'deskripsi' => 'nullable|string',      
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Adjust file types and size as needed      
            'porto' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Adjust file types and size as needed      
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Adjust file types and size as needed      
            'password' => 'nullable|string|min:8|confirmed', // Password validation      
        ]);      
          
        // Update user data      
        $user->name = $request->username;      
        $user->email = $request->email;      
        $user->nohp = $request->nohp;      
        $user->keahlian = $request->keahlian;      
        $user->deskripsi = $request->deskripsi;      
          
        // Handle file uploads for CV    
        if ($request->hasFile('cv')) {      
            // Hapus CV lama jika ada    
            if ($user->CV) {    
                @unlink(public_path('cvs/' . $user->CV));    
            }    
                
            $cvFile = $request->file('cv');    
            $cvName = time() . '_cv.' . $cvFile->getClientOriginalExtension(); // Create a unique name    
            $cvFile->move(public_path('cvs'), $cvName); // Move to 'public/cvs'    
            $user->CV = $cvName; // Save the new CV name    
        }      
          
        // Handle file uploads for portfolio    
        if ($request->hasFile('porto')) {      
            // Hapus portfolio lama jika ada    
            if ($user->portofolio) {    
                @unlink(public_path('portfolios/' . $user->portofolio));    
            }    
                
            $portoFile = $request->file('porto');    
            $portoName = time() . '_porto.' . $portoFile->getClientOriginalExtension(); // Create a unique name    
            $portoFile->move(public_path('portfolios'), $portoName); // Move to 'public/portfolios'    
            $user->portofolio = $portoName; // Save the new portfolio name    
        }      
          
        // Handle profile picture upload      
        if ($request->hasFile('profil_picture')) {    
            $imageName = time() . '.' . $request->profil_picture->extension();    
            $request->profil_picture->move(public_path('images'), $imageName);    
            $user->profil_picture = $imageName;    
        }    
          
        // Handle password update  
        if ($request->filled('password')) {  
            $user->password = Hash::make($request->password);  
        }  
          
        $user->save(); // Save the updated user data      
          
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.'); // Redirect back with success message      
    }    
}  
