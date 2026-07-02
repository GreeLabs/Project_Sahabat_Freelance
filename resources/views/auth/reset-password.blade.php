@extends('layouts.public.auth', [
    'title' => 'Reset Password | Sahabat Freelance',
    'description' => 'Atur ulang password akun Anda.',
])

@section('content')
<div class="auth-card">
    <header class="auth-card-header">
        <h2 class="auth-card-title">RESET PASSWORD.</h2>
        <p class="auth-card-copy">
            Silakan masukkan password baru untuk akun Anda.
        </p>
    </header>

    @if ($errors->any())
        <div class="auth-alert" role="alert" aria-live="assertive">
            <strong>Gagal mengatur ulang password.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="auth-form mt-4" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="auth-field">
            <label for="email">Email <span aria-hidden="true">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $email ?? '') }}"
                autocomplete="email"
                inputmode="email"
                placeholder="nama@email.com"
                aria-describedby="email-hint @error('email') email-error @enderror"
                @error('email') aria-invalid="true" @enderror
                required
                autofocus
                readonly
            >
            @error('email')
                <p class="auth-field-error" id="email-error" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field mt-3">
            <label for="password">Password Baru <span aria-hidden="true">*</span></label>
            <div class="auth-input-wrap">
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    aria-describedby="password-hint @error('password') password-error @enderror"
                    @error('password') aria-invalid="true" @enderror
                    required
                >
                <button class="auth-password-toggle" type="button" data-password-toggle="password" aria-label="Tampilkan password" aria-pressed="false">
                    <i class="bi bi-eye-slash" aria-hidden="true"></i>
                </button>
            </div>
            @error('password')
                <p class="auth-field-error" id="password-error" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field mt-3">
            <label for="password_confirmation">Konfirmasi Password <span aria-hidden="true">*</span></label>
            <div class="auth-input-wrap">
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    autocomplete="new-password"
                    placeholder="Ulangi password baru"
                    required
                >
                <button class="auth-password-toggle" type="button" data-password-toggle="password_confirmation" aria-label="Tampilkan password" aria-pressed="false">
                    <i class="bi bi-eye-slash" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn auth-submit mt-4">
            Simpan Password
            <i class="bi bi-check-lg" aria-hidden="true"></i>
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.passwordToggle);
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            button.setAttribute('aria-pressed', String(!showing));
            button.setAttribute('aria-label', showing ? 'Tampilkan password' : 'Sembunyikan password');
            button.querySelector('i').className = showing ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    });
</script>
@endpush
