@extends('layouts.public.auth', [
    'title' => 'Status Verifikasi | Sahabat Freelance',
    'description' => 'Status verifikasi akun Sahabat Freelance.',
])

@section('content')
<div class="auth-status-card">
    <div class="auth-status-icon" aria-hidden="true">
        <i class="bi bi-shield-check"></i>
    </div>
    <span class="auth-eyebrow">Status akun</span>
    <h2>CEK EMAIL ANDA.</h2>

    @if (session('status'))
        <div class="alert alert-success" role="status" aria-live="polite">
            {{ session('status') }}
        </div>
    @else
        <p>Tautan aktivasi telah dikirim. Setelah verifikasi berhasil, Anda dapat kembali dan masuk ke dashboard.</p>
    @endif

    <a class="btn auth-submit" href="{{ route('login') }}">
        Kembali ke halaman masuk
        <i class="bi bi-arrow-right" aria-hidden="true"></i>
    </a>
</div>
@endsection
