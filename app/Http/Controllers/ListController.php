<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class ListController extends Controller
{
    public function index()
    {
        $admins = Admin::all(); //menampilkan semua data pada tabel Admin
        $users = User::all(); //menampilkan semua data pada tabel user

        return view('beranda', compact('admins', 'users'));
    }
}
