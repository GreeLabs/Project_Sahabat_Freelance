@extends('layouts.user.main')

@section('content')
<div class="content-wrapper-modern">
    <section class="header-section mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="nb-badge mb-3">Kelola Akun</span>
                <h1 class="page-title mb-3">Edit Profil</h1>
                <p class="mb-0">Perbarui data diri, keahlian, CV, dan portofolio agar mitra lebih mudah menilai profilmu.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <img
                    src="{{ asset('images/' . $user->profil_picture) }}"
                    class="profile-preview"
                    alt="Foto profil {{ $user->name }}"
                >
            </div>
        </div>
    </section>

    <div class="row g-4">
        <aside class="col-lg-4">
            <div class="card-modern h-100">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <img
                        src="{{ asset('images/' . $user->profil_picture) }}"
                        class="avatar-lg"
                        alt="Foto profil {{ $user->name }}"
                    >
                    <div>
                        <h3 class="mb-1">{{ $user->name }}</h3>
                        <p class="text-secondary mb-0">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="profile-meta-list">
                    <div class="profile-meta-item">
                        <span>Status</span>
                        <strong>{{ $user->status ?? 'Belum tersedia' }}</strong>
                    </div>
                    <div class="profile-meta-item">
                        <span>Keahlian</span>
                        <strong>{{ $user->keahlian ?: 'Belum diisi' }}</strong>
                    </div>
                    <div class="profile-meta-item">
                        <span>Nomor HP</span>
                        <strong>{{ $user->nohp ?: 'Belum diisi' }}</strong>
                    </div>
                </div>
            </div>
        </aside>

        <div class="col-lg-8">
            <div class="card-modern">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div>
                        <h2 class="mb-1">Data Profil</h2>
                        <p class="text-secondary mb-0">Gunakan data yang akurat dan mudah diverifikasi.</p>
                    </div>
                    <a href="{{ route('user.dashboard') }}" class="nb-btn nb-btn-secondary">Kembali</a>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nohp">Nomor HP</label>
                            <input type="text" class="form-control" id="nohp" name="nohp" value="{{ old('nohp', $user->nohp) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="keahlian">Keahlian</label>
                            <input type="text" class="form-control" id="keahlian" name="keahlian" value="{{ old('keahlian', $user->keahlian) }}">
                        </div>
                        <div class="col-12">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="deskripsi" rows="4">{{ old('deskripsi', $user->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="document-grid my-4">
                        <div class="document-card">
                            <div>
                                <span class="nb-badge nb-btn-secondary mb-2">CV</span>
                                <h3 class="mb-2">Curriculum Vitae</h3>
                                <p class="text-secondary mb-3">Unggah CV terbaru dalam format yang mudah dibaca.</p>
                            </div>
                            @if($user->CV)
                                <a href="{{ asset('cvs/' . $user->CV) }}" target="_blank" class="nb-btn mb-3">Lihat CV Saat Ini</a>
                            @endif
                            <label for="cv">Ganti CV</label>
                            <input type="file" class="form-control" id="cv" name="cv">
                        </div>

                        <div class="document-card">
                            <div>
                                <span class="nb-badge nb-btn-secondary mb-2">Portofolio</span>
                                <h3 class="mb-2">Portofolio</h3>
                                <p class="text-secondary mb-3">Tampilkan hasil kerja terbaik untuk memperkuat profil.</p>
                            </div>
                            @if($user->portofolio)
                                <a href="{{ asset('portfolios/' . $user->portofolio) }}" target="_blank" class="nb-btn mb-3">Lihat Portofolio Saat Ini</a>
                            @endif
                            <label for="porto">Ganti Portofolio</label>
                            <input type="file" class="form-control" id="porto" name="porto">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="profil_picture">Foto Profil</label>
                            <input type="file" class="form-control" id="profil_picture" name="profil_picture">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto profil.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <button type="submit" class="nb-btn nb-btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('user.dashboard') }}" class="nb-btn">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
