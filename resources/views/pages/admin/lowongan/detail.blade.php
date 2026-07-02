@extends('layouts.admin.main')
@section('title', 'Detail Lowongan')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header" style="background: var(--nb-surface); border: 1px solid var(--nb-border); box-shadow: var(--nb-shadow-sm); border-radius: 8px; border-left: 4px solid var(--nb-primary);">
            <h1 style="font-family: var(--nb-font-display);">Detail Lowongan: {{ $lamaran->nama_lowongan }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.lowongan') }}" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Manajemen Lowongan</a></div>
                <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Detail</a></div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card nb-card" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 8px; box-shadow: var(--nb-shadow-sm);">
                    <div class="card-header" style="border-bottom: 1px solid var(--nb-border); background: transparent;">
                        <h4 style="font-family: var(--nb-font-display); font-size: 1.2rem; color: var(--nb-ink);"><i class="fas fa-briefcase text-primary mr-2"></i> Informasi Lowongan Pekerjaan</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 style="font-family: var(--nb-font-display); font-size: 1.1rem; font-weight: 600; color: var(--nb-ink);">Deskripsi Lowongan</h5>
                            <p style="color: var(--nb-muted); line-height: 1.7;">{{ $lamaran->deskripsi }}</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 style="font-family: var(--nb-font-ui); font-size: 0.85rem; font-weight: bold; color: var(--nb-muted); text-transform: uppercase;">Lokasi</h6>
                                <p style="font-family: var(--nb-font-ui); font-size: 1.05rem; font-weight: 600; color: var(--nb-ink);"><i class="fas fa-map-marker-alt text-danger mr-2"></i> {{ $lamaran->lokasi }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 style="font-family: var(--nb-font-ui); font-size: 0.85rem; font-weight: bold; color: var(--nb-muted); text-transform: uppercase;">Rentang Gaji</h6>
                                <div class="d-flex align-items-center">
                                    <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: var(--nb-success); font-size: 0.9rem; padding: 6px 12px; border: 1px solid rgba(16, 185, 129, 0.2);">Rp{{ number_format($lamaran->gaji_minimal, 0, ',', '.') }}</span>
                                    <span class="mx-2 text-muted">-</span>
                                    <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: var(--nb-success); font-size: 0.9rem; padding: 6px 12px; border: 1px solid rgba(16, 185, 129, 0.2);">Rp{{ number_format($lamaran->gaji_maksimal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card nb-card" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 8px; box-shadow: var(--nb-shadow-sm);">
                    <div class="card-header" style="border-bottom: 1px solid var(--nb-border); background: transparent;">
                        <h4 style="font-family: var(--nb-font-display); font-size: 1.2rem; color: var(--nb-ink);"><i class="fas fa-user-circle text-primary mr-2"></i> Profil Klien (Mitra)</h4>
                    </div>
                    <div class="card-body text-center pt-4">
                        <div class="avatar-container mb-3 d-flex justify-content-center">
                            <div style="width: 80px; height: 80px; background: rgba(30, 58, 138, 0.1); color: var(--nb-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <h5 style="font-family: var(--nb-font-display); font-size: 1.25rem; font-weight: 600; color: var(--nb-ink);">{{ $lamaran->freelancer_name }}</h5>
                        <p class="text-muted mb-4"><i class="fas fa-envelope mr-2"></i> {{ $lamaran->email }}</p>
                        
                        <a href="mailto:{{ $lamaran->email }}" class="btn btn-primary w-100 mb-2" style="background: var(--nb-primary); border: none; font-weight: 600; padding: 10px;">Hubungi Klien</a>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('admin.lowongan') }}" class="btn btn-outline-secondary w-100" style="font-family: var(--nb-font-ui); font-weight: 600; padding: 12px; border-radius: 8px;"><i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Lowongan</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
