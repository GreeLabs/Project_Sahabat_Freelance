@extends('layouts.public.auth', [
    'title' => 'Akun Ditangguhkan | Sahabat Freelance',
    'description' => 'Akun Anda telah ditangguhkan.',
])

@section('content')
<div class="auth-card" style="text-align: center;">
    <header class="auth-card-header mb-4">
        <div style="font-size: 3rem; color: var(--nb-danger); margin-bottom: 1rem;">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h2 class="auth-card-title text-danger">AKUN DITANGGUHKAN.</h2>
    </header>

    <div class="auth-alert" role="alert" style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid var(--nb-danger); text-align: left;">
        <strong>Akses Ditolak!</strong>
        <p class="mt-2 mb-0" style="color: var(--nb-ink); font-size: 0.95rem;">
            Akun Anda telah dinonaktifkan sementara (Suspended) oleh sistem kami karena melanggar syarat dan ketentuan, atau membutuhkan tinjauan dari Administrator.
        </p>
    </div>

    <div class="mt-4">
        <p style="color: var(--nb-muted); font-size: 0.9rem;">
            Jika Anda merasa ini adalah sebuah kesalahan atau ingin mengajukan banding, silakan hubungi tim dukungan kami.
        </p>
    </div>

    <div class="d-flex flex-column gap-3 mt-4">
        <a href="mailto:admin@remakefreelance.com?subject=Banding%20Penangguhan%20Akun" class="btn auth-submit" style="background: var(--nb-primary);">
            <i class="bi bi-envelope-fill mr-2"></i> Hubungi Administrator
        </a>
        <a href="{{ route('login') }}" class="btn auth-submit" style="background: var(--nb-surface); color: var(--nb-ink); border: 2px solid var(--nb-border);">
            Kembali ke Halaman Login
        </a>
    </div>
</div>
@endsection
