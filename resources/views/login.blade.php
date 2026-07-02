@extends('layouts.public.auth', [
    'title' => 'Masuk | Sahabat Freelance',
    'description' => 'Masuk ke akun Sahabat Freelance sebagai user, mitra, atau admin.',
])

@section('content')
<div class="auth-card">
    <header class="auth-card-header">
        <span class="auth-eyebrow">Selamat datang kembali</span>
        <h2 class="auth-card-title">MASUK AKUN.</h2>
        <p class="auth-card-copy">
            Belum punya akun?
            <a class="auth-inline-link" href="{{ route('register') }}">Daftar gratis</a>
        </p>
    </header>

    @if ($errors->any())
        <div class="auth-alert" role="alert" aria-live="assertive">
            <strong>Login belum dapat diproses.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="auth-social-grid" aria-label="Pilihan masuk dengan Google">
        <a href="{{ route('redirect') }}" class="auth-social-btn">
            <i class="bi bi-google" aria-hidden="true"></i>
            Masuk sebagai User dengan Google
        </a>
        <a href="{{ route('login.google.mitra') }}" class="auth-social-btn auth-social-btn--dark">
            <i class="bi bi-google" aria-hidden="true"></i>
            Masuk sebagai Mitra dengan Google
        </a>
    </div>

    <div class="auth-divider"><span>atau gunakan email</span></div>

    <form class="auth-form" action="/loginC" method="POST">
        @csrf

        <div class="auth-field">
            <label for="email">Email <span aria-hidden="true">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                inputmode="email"
                placeholder="nama@email.com"
                aria-describedby="email-hint @error('email') email-error @enderror"
                @error('email') aria-invalid="true" @enderror
                required
                autofocus
            >
            <p class="auth-field-hint" id="email-hint">Gunakan email yang terdaftar pada akun Anda.</p>
            @error('email')
                <p class="auth-field-error" id="email-error" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-field">
            <label for="password">Password <span aria-hidden="true">*</span></label>
            <div class="auth-input-wrap">
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    placeholder="8-15 karakter"
                    aria-describedby="password-hint @error('password') password-error @enderror"
                    @error('password') aria-invalid="true" @enderror
                    required
                >
                <button class="auth-password-toggle" type="button" data-password-toggle="password" aria-label="Tampilkan password" aria-pressed="false">
                    <i class="bi bi-eye-slash" aria-hidden="true"></i>
                </button>
            </div>
            <p class="auth-field-hint" id="password-hint">Password terdiri dari 8 sampai 15 karakter.</p>
            @error('password')
                <p class="auth-field-error" id="password-error" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form-options">
            <label class="auth-check" for="remember">
                <input type="checkbox" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Tetap masuk di perangkat ini
            </label>
            <div class="d-flex flex-column align-items-end gap-2">
                <a class="auth-inline-link" href="{{ route('password.request') }}">Lupa Password?</a>
                <a class="auth-inline-link" href="mailto:SahabatFreelance@gmail.com?subject=Bantuan%20akses%20akun">Butuh bantuan?</a>
            </div>
        </div>

        <button type="submit" class="btn auth-submit">
            Masuk sekarang
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
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
