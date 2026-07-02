<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $pekerjaanCount = Pekerjaan::count();
        $mitraCount = Mitra::count();
        
        // Chart Data (Last 7 Months)
        $labels = [];
        $userData = [];
        $jobData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->translatedFormat('F');
            
            $userData[] = User::whereYear('created_at', $month->year)
                              ->whereMonth('created_at', $month->month)
                              ->count();
                              
            $jobData[] = Pekerjaan::whereYear('created_at', $month->year)
                                  ->whereMonth('created_at', $month->month)
                                  ->count();
        }

        // Recent Activity
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        
        // Pending Actions (Example: Jobs needing review if there is a status column, otherwise just recent jobs)
        $recentJobs = Pekerjaan::with('mitra')->orderBy('created_at', 'desc')->take(5)->get();

        return view('pages.admin.index', compact(
            'userCount', 'pekerjaanCount', 'mitraCount', 
            'labels', 'userData', 'jobData',
            'recentUsers', 'recentJobs'
        ));
    }
}
