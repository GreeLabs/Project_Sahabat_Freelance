@extends('layouts.public.auth', [
    'title' => 'Lengkapi Profil | Sahabat Freelance',
    'description' => 'Lengkapi profil awal akun Sahabat Freelance.',
])

@section('content')
<div class="auth-card">
    <header class="auth-card-header">
        <span class="auth-eyebrow">Profil awal</span>
        <h2 class="auth-card-title">LENGKAPI PROFIL.</h2>
        <p class="auth-card-copy">Informasi yang jelas membantu mitra memahami keahlian dan pengalaman Anda.</p>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="auth-alert" role="alert" aria-live="assertive">
            <strong>Profil belum dapat disimpan.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="auth-form" action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="auth-field">
            <label for="name">Nama lengkap <span aria-hidden="true">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()?->name) }}" autocomplete="name" required>
            @error('name')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="email">Email <span aria-hidden="true">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()?->email) }}" autocomplete="email" required>
            @error('email')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="description">Deskripsi singkat</label>
            <textarea id="description" name="deskripsi" rows="5" placeholder="Ceritakan keahlian, pengalaman, dan jenis proyek yang Anda cari.">{{ old('deskripsi', auth()->user()?->deskripsi) }}</textarea>
            <p class="auth-field-hint">Hindari membagikan data pribadi sensitif.</p>
            @error('deskripsi')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="profile-picture">Foto profil</label>
            <input type="file" id="profile-picture" name="profile_picture" accept="image/jpeg,image/png,image/webp">
            <p class="auth-field-hint">JPG, PNG, atau WebP. Maksimal 2 MB.</p>
            @error('profile_picture')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="cv">Curriculum Vitae</label>
            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx">
            <p class="auth-field-hint">PDF, DOC, atau DOCX. Maksimal 2 MB.</p>
            @error('cv')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field">
            <label for="portfolio">Portofolio</label>
            <input type="file" id="portfolio" name="portofolio" accept=".pdf,.doc,.docx">
            <p class="auth-field-hint">Unggah ringkasan karya terbaik Anda, maksimal 2 MB.</p>
            @error('portofolio')<p class="auth-field-error" role="alert">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="btn auth-submit">
            Simpan profil
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </button>
    </form>
</div>
@endsection
