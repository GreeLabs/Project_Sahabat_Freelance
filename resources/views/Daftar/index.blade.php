@extends('layouts.public.auth', [
    'title' => 'Daftar | Sahabat Freelance',
    'description' => 'Buat akun User atau Mitra di Sahabat Freelance.',
])

@section('content')
<div class="auth-card">
    <header class="auth-card-header">
        <span class="auth-eyebrow">Buat akun baru</span>
        <h2 class="auth-card-title">MULAI BERGABUNG.</h2>
        <p class="auth-card-copy">
            Sudah memiliki akun?
            <a class="auth-inline-link" href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </header>

    @if ($errors->any())
        <div class="auth-alert" role="alert" aria-live="assertive">
            <strong>Data pendaftaran perlu diperbaiki.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="auth-tabs" role="tablist" aria-label="Pilih jenis akun">
        <button class="auth-tab" type="button" role="tab" id="user-tab" aria-controls="user-panel" aria-selected="{{ old('account_type', 'user') === 'user' ? 'true' : 'false' }}" data-auth-tab="user-panel">
            Akun User
        </button>
        <button class="auth-tab" type="button" role="tab" id="mitra-tab" aria-controls="mitra-panel" aria-selected="{{ old('account_type') === 'mitra' ? 'true' : 'false' }}" data-auth-tab="mitra-panel">
            Akun Mitra
        </button>
    </div>

    <section class="auth-tab-panel" id="user-panel" role="tabpanel" aria-labelledby="user-tab" {{ old('account_type', 'user') === 'user' ? '' : 'hidden' }}>
        <div class="auth-social-grid">
            <a href="{{ route('redirect') }}" class="auth-social-btn">
                <i class="bi bi-google" aria-hidden="true"></i>
                Daftar User dengan Google
            </a>
        </div>

        <div class="auth-divider"><span>atau gunakan email</span></div>

        <form class="auth-form" action="{{ route('post.register') }}" method="POST">
            @csrf
            <input type="hidden" name="account_type" value="user">

            <div class="auth-field">
                <label for="user-name">Nama lengkap <span aria-hidden="true">*</span></label>
                <input type="text" id="user-name" name="name" value="{{ old('account_type', 'user') === 'user' ? old('name') : '' }}" autocomplete="name" placeholder="Nama lengkap Anda" required>
                @error('name')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="auth-field">
                <label for="user-email">Email <span aria-hidden="true">*</span></label>
                <input type="email" id="user-email" name="email" value="{{ old('account_type', 'user') === 'user' ? old('email') : '' }}" autocomplete="email" inputmode="email" placeholder="nama@email.com" required>
                @error('email')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="auth-field">
                <label for="user-phone">Nomor WhatsApp <span aria-hidden="true">*</span></label>
                <input type="tel" id="user-phone" name="nohp" value="{{ old('account_type', 'user') === 'user' ? old('nohp') : '' }}" autocomplete="tel" inputmode="tel" placeholder="08123456789" required>
                @error('nohp')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="auth-field">
                <label for="user-password">Password <span aria-hidden="true">*</span></label>
                <div class="auth-input-wrap">
                    <input type="password" id="user-password" name="password" autocomplete="new-password" placeholder="8-15 karakter" required>
                    <button class="auth-password-toggle" type="button" data-password-toggle="user-password" aria-label="Tampilkan password" aria-pressed="false"><i class="bi bi-eye-slash" aria-hidden="true"></i></button>
                </div>
                <p class="auth-field-hint">Gunakan kombinasi yang tidak dipakai di akun lain.</p>
                @error('password')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn auth-submit">Daftar sebagai User <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
        </form>
    </section>

    <section class="auth-tab-panel" id="mitra-panel" role="tabpanel" aria-labelledby="mitra-tab" {{ old('account_type') === 'mitra' ? '' : 'hidden' }}>
        <div class="auth-social-grid">
            <a href="{{ route('login.google.mitra') }}" class="auth-social-btn auth-social-btn--dark">
                <i class="bi bi-google" aria-hidden="true"></i>
                Daftar Mitra dengan Google
            </a>
        </div>

        <div class="auth-divider"><span>atau gunakan email</span></div>

        <form class="auth-form" action="{{ route('post.register2') }}" method="POST">
            @csrf
            <input type="hidden" name="account_type" value="mitra">

            <div class="auth-field">
                <label for="mitra-name">Nama usaha atau mitra <span aria-hidden="true">*</span></label>
                <input type="text" id="mitra-name" name="name" value="{{ old('account_type') === 'mitra' ? old('name') : '' }}" autocomplete="organization" placeholder="Nama usaha atau mitra" required>
                @error('name')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="auth-field">
                <label for="mitra-email">Email bisnis <span aria-hidden="true">*</span></label>
                <input type="email" id="mitra-email" name="email" value="{{ old('account_type') === 'mitra' ? old('email') : '' }}" autocomplete="email" inputmode="email" placeholder="bisnis@email.com" required>
                @error('email')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="auth-field">
                <label for="mitra-phone">Nomor WhatsApp <span aria-hidden="true">*</span></label>
                <input type="tel" id="mitra-phone" name="nohp" value="{{ old('account_type') === 'mitra' ? old('nohp') : '' }}" autocomplete="tel" inputmode="tel" placeholder="08123456789" required>
                @error('nohp')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="auth-field">
                <label for="mitra-password">Password <span aria-hidden="true">*</span></label>
                <div class="auth-input-wrap">
                    <input type="password" id="mitra-password" name="password" autocomplete="new-password" placeholder="8-15 karakter" required>
                    <button class="auth-password-toggle" type="button" data-password-toggle="mitra-password" aria-label="Tampilkan password" aria-pressed="false"><i class="bi bi-eye-slash" aria-hidden="true"></i></button>
                </div>
                <p class="auth-field-hint">Gunakan kombinasi yang tidak dipakai di akun lain.</p>
                @error('password')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn auth-submit">Daftar sebagai Mitra <i class="bi bi-arrow-right" aria-hidden="true"></i></button>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
    const tabs = document.querySelectorAll('[data-auth-tab]');
    const panels = document.querySelectorAll('.auth-tab-panel');

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach((item) => item.setAttribute('aria-selected', 'false'));
            panels.forEach((panel) => panel.hidden = true);
            tab.setAttribute('aria-selected', 'true');
            document.getElementById(tab.dataset.authTab).hidden = false;
        });

        tab.addEventListener('keydown', (event) => {
            if (!['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
            event.preventDefault();
            const nextIndex = event.key === 'ArrowRight'
                ? (Array.from(tabs).indexOf(tab) + 1) % tabs.length
                : (Array.from(tabs).indexOf(tab) - 1 + tabs.length) % tabs.length;
            tabs[nextIndex].click();
            tabs[nextIndex].focus();
        });
    });

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
