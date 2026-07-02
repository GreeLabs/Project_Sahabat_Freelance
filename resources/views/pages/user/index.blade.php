@extends('layouts.user.main')

@section('content')
<div class="content-wrapper-modern">
    {{-- Top Row: Welcome + Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card nb-card h-100 p-4 d-flex align-items-center flex-row" style="background: var(--nb-soft); border-radius: 0;">
                <div class="flex-grow-1">
                    <h3 class="fw-bold mb-2" style="font-family: var(--nb-font-display);">Selamat datang, {{ $user->name }}!</h3>
                    <p class="text-secondary mb-4" style="font-weight: 500;">Lengkapi profilmu agar UMKM lebih mudah menemukanmu.</p>
                    <a href="{{ route('profile.edit') }}" class="nb-btn btn-primary px-4">Lengkapi Sekarang</a>
                </div>
                <div class="ms-auto d-none d-md-block">
                    <img src="{{ asset('mitra/images/dashboard/job.jpg') }}" style="max-height: 130px; border: var(--nb-border); box-shadow: var(--nb-shadow);" alt="illustration">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row g-4 h-100">
                <div class="col-6">
                    <div class="card nb-card text-center h-100 d-flex flex-column justify-content-center p-3" style="background: var(--nb-cyan); border-radius: 0;">
                        <i class="fas fa-briefcase fs-1 mb-2" style="color: var(--nb-ink);"></i>
                        <p class="fw-semibold mb-1 text-uppercase" style="font-size: 0.85rem;">Total Lowongan Aktif</p>
                        <div class="stat-number" style="font-family: var(--nb-font-display); font-size: 2.5rem;">{{ $Pekerjaan }}</div>
                        <a href="{{ route('user.carijob') }}" class="nb-btn btn-sm btn-light mt-3" style="background: white;">Cari Sekarang</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card nb-card text-center h-100 d-flex flex-column justify-content-center p-3" style="background: var(--nb-warning); border-radius: 0;">
                        <i class="fas fa-gem fs-1 mb-2" style="color: var(--nb-ink);"></i>
                        <p class="fw-semibold mb-1 text-uppercase" style="font-size: 0.85rem;">Points Anda</p>
                        <div class="stat-number" style="font-family: var(--nb-font-display); font-size: 2.5rem;">{{ $user->point ?? 0 }}</div>
                        <span class="nb-badge nb-badge-primary mt-2 mx-auto">{{ $user->status ?? 'Member' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Penawaran Terbatas + Rekomendasi --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card nb-card h-100 p-4" style="background: var(--nb-paper); border-radius: 0;">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-crown fs-3 me-2" style="color: var(--nb-warning);"></i>
                    <h4 class="fw-bold mb-0" style="font-family: var(--nb-font-display);">Tingkatkan Akunmu!</h4>
                </div>
                <p class="text-secondary" style="font-weight: 500;">Dapatkan akses tak terbatas dan jadilah prioritas di mata UMKM dengan paket premium kami.</p>
                
                <div class="mt-4 text-center">
                    <img src="{{ asset('mitra/images/dashboard/promotion.jpg') }}" class="img-fluid mb-4" style="border: var(--nb-border); max-height: 200px; object-fit: cover; width: 100%;" alt="promo">
                    <a href="{{ route('user.payment') }}" class="nb-btn btn-warning w-100">Lihat Paket Langganan</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card nb-card h-100 p-4" style="background: var(--nb-surface); border-radius: 0;">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2" style="border-bottom: 2px solid var(--nb-ink);">
                    <h4 class="fw-bold mb-0" style="font-family: var(--nb-font-display);">Rekomendasi Lowongan</h4>
                    <a href="{{ route('user.carijob') }}" class="text-primary fw-bold" style="text-decoration: underline;">Lihat semua</a>
                </div>
                <div class="row g-3 mt-1">
                    @forelse ($pekerjaans->take(4) as $pekerjaan)
                        <div class="col-6">
                            <div class="card nb-card p-0 h-100 d-flex flex-column" style="background: var(--nb-paper);">
                                <img src="{{ asset('images/' . $pekerjaan->foto) }}" class="card-img-top" style="height: 120px; object-fit: cover; border-bottom: var(--nb-border);" alt="{{ $pekerjaan->nama_lowongan }}">
                                <div class="p-3 d-flex flex-column flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $pekerjaan->nama_lowongan }}</h6>
                                    <p class="small text-secondary mb-3 flex-grow-1">{{ Str::limit($pekerjaan->deskripsi, 40) }}</p>
                                    <a href="{{ route('carijob.detail', $pekerjaan->id) }}" class="nb-btn btn-sm btn-primary text-center w-100">Detail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="p-4 text-center" style="background: var(--nb-soft); border: var(--nb-border);">
                                <p class="mb-0 fw-bold">Belum ada lowongan rekomendasi saat ini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Iklan --}}
    @if(count($contents) > 0)
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card nb-card p-4" style="background: var(--nb-primary); color: var(--nb-surface);">
                <h4 class="fw-bold mb-4" style="font-family: var(--nb-font-display);">Berita & Promo Terbaru</h4>
                <div class="row g-4">
                    @foreach($contents as $content)
                        <div class="col-md-4">
                            <div class="card nb-card p-0 h-100 text-dark" style="background: var(--nb-surface);">
                                <img src="{{ asset('images/' . $content->image) }}" class="card-img-top" style="height: 150px; object-fit: cover; border-bottom: var(--nb-border);" alt="{{ $content->title }}">
                                <div class="p-3 text-center">
                                    <h6 class="fw-bold">{{ $content->title }}</h6>
                                    <p class="small text-secondary">{{ $content->body }}</p>
                                    <a href="#" class="nb-btn btn-sm btn-cyan">{{ $content->button_name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
