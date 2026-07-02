<?php

namespace App\Services;

use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    private const DEFAULT_POINT = 10000;

    public function login(string $email, string $password): ?string
    {
        if ($this->attemptAdmin($email, $password)) {
            return 'admin.dashboard';
        }

        $mitraStatus = $this->attemptMitra($email, $password);
        if ($mitraStatus === 'suspended') return 'suspended';
        if ($mitraStatus === true) return 'mitra.dashboard';

        $userStatus = $this->attemptUser($email, $password);
        if ($userStatus === 'suspended') return 'suspended';
        if ($userStatus === true) return 'user.dashboard';

        return null;
    }

    private function attemptAdmin(string $email, string $password): bool
    {
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return true;
        }

        return false;
    }

    private function attemptMitra(string $email, string $password): bool|string
    {
        if (Auth::guard('mitra')->attempt(['email' => $email, 'password' => $password])) {
            $mitra = Auth::guard('mitra')->user();
            if ($mitra->status === 'suspended') {
                Auth::guard('mitra')->logout();
                return 'suspended';
            }
            session(['id_mitra' => $mitra->id]);

            return true;
        }

        return false;
    }

    private function attemptUser(string $email, string $password): bool|string
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            if ($user->status === 'suspended') {
                Auth::logout();
                return 'suspended';
            }
            return true;
        }
        return false;
    }

    public function registerUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nohp' => $data['nohp'],
            'password' => Hash::make($data['password']),
            'point' => self::DEFAULT_POINT,
        ]);
    }

    public function registerMitra(array $data): Mitra
    {
        return Mitra::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nohp' => $data['nohp'],
            'password' => Hash::make($data['password']),
            'point' => self::DEFAULT_POINT,
        ]);
    }

    public function handleGoogleCallback($googleUser, string $guard): ?string
    {
        $model = $guard === 'mitra' ? new Mitra : new User;
        $modelClass = $guard === 'mitra' ? Mitra::class : User::class;

        $user = $modelClass::where('google_id', $googleUser->getId())->first();

        if (! $user) {
            $user = $this->createUserFromGoogle($googleUser, $guard);
        }

        if ($user->status === 'suspended') {
            return 'suspended';
        }

        Auth::guard($guard)->login($user);
        session()->regenerate();

        return $guard === 'mitra' ? 'mitra.dashboard' : 'user.dashboard';
    }

    private function createUserFromGoogle($googleUser, string $guard): object
    {
        $password = Str::random(16);
        $data = [
            'google_id' => $googleUser->getId(),
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Hash::make($password),
            'profil_picture' => $googleUser->getAvatar(),
            'nohp' => '-',
        ];

        return $guard === 'mitra'
            ? Mitra::create($data)
            : User::create($data);
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
        Auth::guard('mitra')->logout();
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
