<?php

use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Mitra\ChatController;
use App\Http\Controllers\Mitra\User1Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Auth\EditProfilController;
use App\Http\Controllers\Mitra\FreelanceController;
use App\Http\Controllers\Mitra\JobController;
use App\Http\Controllers\Mitra\MitraController;
use App\Http\Controllers\Mitra\NotificationsController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Mitra\LamarController;
use App\Http\Controllers\User\CariJobController;
use App\Http\Controllers\User\EditProfilController as UserEditProfilController;
use App\Http\Controllers\User\KelolaController;
use App\Http\Controllers\User\PaymentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// ========================
// Public / Guest Routes
// ========================
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        $mitraCount = \App\Models\Mitra::count() ?? 10;
        $userCount = \App\Models\User::count() ?? 200;
        $jobCount = \App\Models\Pekerjaan::count() ?? 50;
        return view('welcome', compact('mitraCount', 'userCount', 'jobCount'));
    });

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');
    Route::post('/post-register2', [AuthController::class, 'post_register2'])->name('post.register2');

    Route::post('/loginC', [AuthController::class, 'login']);

    // Password Reset Routes
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetController::class, 'edit'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'update'])->name('password.update');
});

Route::get('/suspended', function () {
    return view('auth.suspended');
})->name('suspended');

// Login (accessible to guests, not duplicated)
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Google OAuth
Route::middleware('guest')->group(function () {
    Route::get('login/google/redirect', [AuthController::class, 'redirect'])->name('redirect');
    Route::get('login/google/callback', [AuthController::class, 'callback'])->name('callback');
    Route::get('login/mitra/google', [AuthController::class, 'redirectMitra'])->name('login.google.mitra');
    Route::get('login/mitra/google/callback', [AuthController::class, 'callbackMitra'])->name('login.google.callback.mitra');
});

// Email Verification (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/user/editprofil');
    })->middleware('signed')->name('verification.verify');
});

Route::get('/email/verify/{id}/{type}', [VerificationController::class, 'verify'])->name('verification.verify.custom');

// Edit profil setelah register (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/editprofil', [EditProfilController::class, 'index'])->name('register.editprofil');
    Route::post('/update-profile', [EditProfilController::class, 'updateProfile'])->name('update.profile');
});

// Logout
Route::post('logout', [AuthController::class, 'user_logout'])->name('logout');
Route::post('admin/logout', [AuthController::class, 'admin_logout'])->name('admin.logout');

Route::group(['middleware' => ['admin', 'web']], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/content', [ContentController::class, 'index'])->name('admin.konten');
    Route::post('/admin/content', [ContentController::class, 'store'])->name('konten.store');
    Route::put('/admin/konten/{id}/update', [ContentController::class, 'update'])->name('konten.update');
    Route::get('/admin/konten/{id}/edit', [ContentController::class, 'edit'])->name('konten.edit');

    Route::delete('/konten/{id}', [ContentController::class, 'destroy'])->name('konten.destroy');

    
// Rute untuk menampilkan halaman manajemen layanan premium
Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services');

// Rute untuk menyimpan layanan baru
Route::post('/admin/services', [ServiceController::class, 'store'])->name('services.store');

// Rute untuk memperbarui layanan
Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('services.update');

// Rute untuk menghapus layanan
Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('/admin/lowongan', [LowonganController::class, 'index'])->name('admin.lowongan');
    Route::get('/admin/lowongan/{id}', [LowonganController::class, 'detail'])->name('admin.lowongan.detail');
    Route::get('/admin/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna');
    Route::post('/admin/pengguna/suspenduser/{id}', [PenggunaController::class, 'suspendUser'])->name('pengguna.suspendu');
Route::post('/admin/pengguna/suspendmitra/{id}', [PenggunaController::class, 'suspendMitra'])->name('pengguna.suspendm');

// Rute untuk memperbarui pengguna
Route::put('/admin/pengguna/update/{id}', [PenggunaController::class, 'updateUser'])->name('pengguna.update');

// Rute untuk memperbarui mitra
Route::put('/admin/pengguna/update-mitra/{id}', [PenggunaController::class, 'updateMitra'])->name('pengguna.updateMitra');

Route::get('/admin/notifications/create', [NotificationController::class, 'create'])->name('admin.notifikasi');  
Route::post('/admin/notifications', [NotificationController::class, 'store'])->name('notifications.store'); 
});
Route::group(['middleware' => ['mitra', 'web']], function() {
    Route::get('/mitra/index', [MitraController::class, 'index'])->name('mitra.dashboard');
    Route::get('/mitra/chat', [ChatController::class, 'index'])->name('mitra.chat');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');  
// Rute untuk mendapatkan pesan  
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::get('/mitra/freelance', [FreelanceController::class, 'index'])->name('mitra.freelance');
    Route::get('/mitra/freelance/detail/{id}', [FreelanceController::class, 'detail'])->name('freelance.detail');
    Route::post('/submit-rating', [FreelanceController::class, 'submitRating'])->name('submit.rating');  

    Route::post('/tawarkan-pekerjaan', [FreelanceController::class, 'tawarkanPekerjaan'])->name('tawarkan_pekerjaan');
    Route::get('/mitra/notifications', [NotificationsController::class, 'index'])->name('mitra.notifications');
    // Route untuk menandai notifikasi sebagai dibaca  
Route::post('/mitra/notifications/mark-as-read/{id}', [NotificationsController::class, 'markAsRead'])->name('mitra.notifications.markAsRead');  
  
// Route untuk menambahkan notifikasi baru (contoh)  
Route::post('/mitra/notifications/add', [NotificationsController::class, 'addNotification'])->name('mitra.notifications.add');  

    Route::get('/mitra/user', [User1Controller::class, 'index'])->name('mitra.user');
    Route::post('/mitra/user/update', [User1Controller::class, 'updateProfile'])->name('mitra.updateProfile');
    Route::get('/mitra/lamar', [LamarController::class, 'index'])->name('mitra.lamar');
    Route::put('/mitra/{id}/lamar', [LamarController::class, 'updateStatus'])->name('mitra.lamar.updateStatus');
    Route::get('/mitra/job', [JobController::class, 'index'])->name('mitra.job');
    Route::post('/lamaran/batalkan/{id}', [CariJobController::class, 'batalkan'])->name('lamaran.batalkan');

    Route::get('/mitra/job/{id}/detail', [JobController::class, 'detail'])->name('mitra.detailjob');
    Route::get('/job/create', [JobController::class, 'create'])->name('job.create'); 
Route::post('/job/store', [JobController::class, 'store'])->name('job.store'); 

Route::get('/mitra/jobs/{id}/edit', [JobController::class, 'edit'])->name('mitra.editjob');
Route::put('/mitra/jobs/{id}/update', [JobController::class, 'update'])->name('mitra.updatejob');
Route::post('/mitra/jobs/{id}/deactivate', [JobController::class, 'deactivate'])->name('mitra.nonaktifjob');


});



Route::group(['middleware' => ['auth', 'web']], function() {
    Route::get('/user/', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/ketentuan', [UserController::class, 'Ketentuan'])->name('user.ketentuan');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/user/carijob', [CariJobController::class, 'index'])->name('user.carijob');
    Route::post('/user/carijob/{id}/rate', [CariJobController::class, 'rate'])->name('pekerjaan.rate'); 
    Route::get('/user/editprofil', [UserEditProfilController::class, 'edit'])->name('profile.edit');
    Route::post('/user/editprofil/update', [UserEditProfilController::class, 'update'])->name('profile.update');
    Route::get('/user/payment', [PaymentController::class, 'index'])->name('user.payment');
    Route::get('/user/kelolajob', [KelolaController::class, 'index'])->name('user.kelolajob');
    Route::get('/kelolajob/terima/{id}', [KelolaController::class, 'terima'])->name('kelolajob.terima');
Route::get('/kelolajob/tolak/{id}', [KelolaController::class, 'tolak'])->name('kelolajob.tolak');
    Route::get('/user/kelolajob/detail/{id}', [KelolaController::class, 'detail'])->name('kelolajob.detail');
    Route::get('/carijob/detail/{id}', [CariJobController::class, 'detail'])->name('carijob.detail');
    Route::post('/carijob/lamar/{id}', [CariJobController::class, 'lamar'])->name('carijob.lamar');

});