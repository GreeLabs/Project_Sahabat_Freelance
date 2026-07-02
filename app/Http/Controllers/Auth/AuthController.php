<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Pastikan semua email dan password terisi dengan benar!');

            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->only(['email', 'remember']));
        }

        $route = $this->authService->login($request->email, $request->password);

        if ($route === 'suspended') {
            return redirect()->route('suspended');
        }

        if ($route) {
            $this->setWelcomeMessage($route);

            return redirect()->route($route);
        }

        Alert::error('Login Gagal!', 'Email atau password tidak valid!');

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password tidak valid.'])
            ->withInput($request->only(['email', 'remember']));
    }

    private function setWelcomeMessage(string $route): void
    {
        $messages = [
            'admin.dashboard' => 'Selamat datang admin!',
            'user.dashboard' => 'Selamat datang!',
            'mitra.dashboard' => 'Selamat datang mitra!',
        ];
        toast($messages[$route] ?? 'Selamat datang!', 'success');
    }

    public function user_logout()
    {
        $this->authService->logout();
        toast('Berhasil logout!', 'success');

        return redirect('/');
    }

    public function admin_logout()
    {
        $this->authService->logout();
        toast('Berhasil logout!', 'success');

        return redirect('/');
    }

    public function logout()
    {
        $this->authService->logout();
        toast('Berhasil logout!', 'success');

        return redirect('/');
    }

    public function register()
    {
        return view('Daftar/index');
    }

    public function post_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nohp' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');

            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $this->authService->registerUser($request->only(['name', 'email', 'nohp', 'password']));

        Alert::success('Berhasil!', 'Akun berhasil dibuat. Silakan cek email untuk verifikasi!');

        return redirect()->route('login');
    }

    public function post_register2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nohp' => 'required',
            'email' => 'required|email:dns|unique:mitras,email',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');

            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $this->authService->registerMitra($request->only(['name', 'email', 'nohp', 'password']));

        Alert::success('Berhasil!', 'Akun Mitra berhasil dibuat. Silakan cek email untuk verifikasi!');

        return redirect()->route('login');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $route = $this->authService->handleGoogleCallback($googleUser, 'web');

        if ($route === 'suspended') {
            return redirect()->route('suspended');
        }

        return redirect()->route($route);
    }

    public function redirectMitra()
    {
        return Socialite::driver('google_mitra')->redirect();
    }

    public function callbackMitra()
    {
        $googleUser = Socialite::driver('google_mitra')->user();
        $route = $this->authService->handleGoogleCallback($googleUser, 'mitra');

        if ($route === 'suspended') {
            return redirect()->route('suspended');
        }

        return redirect()->route($route);
    }
}
