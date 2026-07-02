<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mitra;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($id, $type)
    {
        if ($type === 'user') {
            $user = User::findOrFail($id);
            $user->email_verified_at = now();
            $user->save();
        } elseif ($type === 'mitra') {
            $mitra = Mitra::findOrFail($id);
            $mitra->email_verified_at = now();
            $mitra->save();
        }

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }
}
