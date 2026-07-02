@extends('layouts.public.auth', [
    'title' => 'Lupa Password | Sahabat Freelance',
    'description' => 'Lupa password akun Sahabat Freelance Anda.',
])

@section('content')
<div class="auth-card">
    <header class="auth-card-header">
        <h2 class="auth-card-title">LUPA PASSWORD.</h2>
        <p class="auth-card-copy">
            Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password.
        </p>
    </header>

    @if (session('status'))
        <div class="auth-alert" role="alert" style="background-color: var(--nb-primary); color: white;">
            <strong>Berhasil!</strong>
            <p>{{ session('status') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="auth-alert" role="alert" aria-live="assertive">
            <strong>Gagal mengirim tautan.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="auth-form mt-4" action="{{ route('password.email') }}" method="POST">
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
            @error('email')
                <p class="auth-field-error" id="email-error" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn auth-submit mt-4">
            Kirim Tautan Reset
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </button>
        
        <div class="auth-form-options mt-4 text-center">
            <a class="auth-inline-link" href="{{ route('login') }}">Kembali ke Login</a>
        </div>
    </form>
</div>
@endsection
