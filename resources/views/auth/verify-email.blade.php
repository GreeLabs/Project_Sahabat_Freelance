@extends('layouts.public.auth', [
    'title' => 'Verifikasi Email | Sahabat Freelance',
    'description' => 'Verifikasi alamat email akun Sahabat Freelance.',
])

@section('content')
<div class="auth-status-card">
    <div class="auth-status-icon" aria-hidden="true">
        <i class="bi bi-envelope-check"></i>
    </div>
    <span class="auth-eyebrow">Satu langkah lagi</span>
    <h2>VERIFIKASI EMAIL.</h2>
    <p>Kami telah mengirim tautan verifikasi ke email Anda. Buka email tersebut dan klik tautannya untuk mengaktifkan akun.</p>

    @if (session('status'))
        <div class="alert alert-success" role="status" aria-live="polite">
            {{ session('status') }}
        </div>
    @endif

    <div class="auth-social-grid">
        <a class="btn auth-submit" href="{{ route('login') }}">
            Kembali ke halaman masuk
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
        <a class="auth-social-btn" href="mailto:SahabatFreelance@gmail.com?subject=Bantuan%20verifikasi%20email">
            <i class="bi bi-life-preserver" aria-hidden="true"></i>
            Hubungi bantuan
        </a>
    </div>
</div>
@endsection
