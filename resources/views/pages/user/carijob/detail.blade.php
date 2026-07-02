@extends('layouts.user.main')

@section('title', 'Detail Pekerjaan - ' . $pekerjaan->nama_lowongan)

@section('content')
<div class="main-content">
    <section class="section">
        <!-- Header/Breadcrumb -->
        <div class="section-header" style="background: var(--nb-surface); border: 1px solid var(--nb-border); box-shadow: var(--nb-shadow-sm); border-radius: 8px; border-left: 4px solid var(--nb-primary);">
            <h1 style="font-family: var(--nb-font-display);">Detail Lowongan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('user.carijob') }}" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Cari Pekerjaan</a></div>
                <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">{{ $pekerjaan->nama_lowongan }}</a></div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Kolom Kiri: Detail Pekerjaan Utama -->
            <div class="col-lg-8 mb-4">
                
                <!-- Hero Image & Basic Info Card -->
                <div class="card nb-card mb-4" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 12px; box-shadow: var(--nb-shadow-sm); overflow: hidden;">
                    @if($pekerjaan->foto)
                    <div style="width: 100%; height: 350px; overflow: hidden; background: var(--nb-soft); display: flex; align-items: center; justify-content: center;">
                        <img src="{{ $pekerjaan->foto }}" alt="{{ $pekerjaan->nama_lowongan }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @else
                    <div style="width: 100%; height: 200px; background: rgba(30, 58, 138, 0.1); display: flex; align-items: center; justify-content: center; color: var(--nb-primary); font-size: 4rem;">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    @endif
                    
                    <div class="card-body p-4 pt-5" style="position: relative;">
                        <!-- Logo Bulat UMKM (Opsional/Visual) -->
                        <div style="position: absolute; top: -40px; left: 24px; width: 80px; height: 80px; background: var(--nb-paper); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid var(--nb-surface); box-shadow: var(--nb-shadow-sm); font-size: 2rem; color: var(--nb-primary);">
                            <i class="fas fa-store"></i>
                        </div>
                        
                        <h2 class="fw-bold mb-2" style="font-family: var(--nb-font-display); color: var(--nb-ink); font-size: 1.8rem;">{{ $pekerjaan->nama_lowongan }}</h2>
                        <h5 class="mb-4" style="font-family: var(--nb-font-ui); color: var(--nb-muted); font-size: 1.1rem; font-weight: 500;">Oleh: <span class="text-primary">{{ $pekerjaan->mitra_name }}</span></h5>
                        
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <span class="badge d-inline-flex align-items-center" style="background: rgba(16, 185, 129, 0.1); color: var(--nb-success); padding: 8px 16px; border-radius: 20px; font-size: 0.9rem; border: 1px solid rgba(16, 185, 129, 0.2);">
                                <i class="fas fa-wallet mr-2"></i> Rp{{ number_format($pekerjaan->gaji_minimal, 0, ',', '.') }} - Rp{{ number_format($pekerjaan->gaji_maksimal, 0, ',', '.') }}
                            </span>
                            <span class="badge d-inline-flex align-items-center" style="background: rgba(239, 68, 68, 0.1); color: var(--nb-danger); padding: 8px 16px; border-radius: 20px; font-size: 0.9rem; border: 1px solid rgba(239, 68, 68, 0.2);">
                                <i class="fas fa-map-marker-alt mr-2"></i> {{ $pekerjaan->lokasi }}
                            </span>
                            <span class="badge d-inline-flex align-items-center" style="background: rgba(56, 189, 248, 0.1); color: var(--nb-cyan); padding: 8px 16px; border-radius: 20px; font-size: 0.9rem; border: 1px solid rgba(56, 189, 248, 0.2);">
                                <i class="fas fa-tag mr-2"></i> {{ $pekerjaan->tipe ?? 'Full-time' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Card -->
                <div class="card nb-card mb-4" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 12px; box-shadow: var(--nb-shadow-sm);">
                    <div class="card-header" style="border-bottom: 1px solid var(--nb-border); background: transparent; padding: 20px 24px;">
                        <h4 style="font-family: var(--nb-font-display); font-size: 1.25rem; color: var(--nb-ink); margin: 0;"><i class="fas fa-align-left text-primary mr-2"></i> Deskripsi Pekerjaan</h4>
                    </div>
                    <div class="card-body p-4">
                        <p style="color: var(--nb-muted); line-height: 1.8; font-size: 1.05rem;">{{ $pekerjaan->deskripsi }}</p>
                    </div>
                </div>

                <!-- Persyaratan Card -->
                <div class="card nb-card mb-4" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 12px; box-shadow: var(--nb-shadow-sm);">
                    <div class="card-header" style="border-bottom: 1px solid var(--nb-border); background: transparent; padding: 20px 24px;">
                        <h4 style="font-family: var(--nb-font-display); font-size: 1.25rem; color: var(--nb-ink); margin: 0;"><i class="fas fa-clipboard-list text-warning mr-2"></i> Persyaratan</h4>
                    </div>
                    <div class="card-body p-4">
                        <div style="color: var(--nb-ink); line-height: 1.8; font-size: 1.05rem;">
                            {!! nl2br(e($pekerjaan->persyaratan)) !!}
                        </div>
                    </div>
                </div>

                <!-- Ulasan Card -->
                <div class="card nb-card" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 12px; box-shadow: var(--nb-shadow-sm);">
                    <div class="card-header d-flex justify-content-between align-items-center" style="border-bottom: 1px solid var(--nb-border); background: transparent; padding: 20px 24px;">
                        <h4 style="font-family: var(--nb-font-display); font-size: 1.25rem; color: var(--nb-ink); margin: 0;"><i class="fas fa-star text-warning mr-2"></i> Rating & Komentar</h4>
                        <div class="text-right">
                            <h5 style="font-family: var(--nb-font-display); font-size: 1.2rem; margin: 0; color: var(--nb-ink);">{{ $pekerjaan->mitra_rating ?? 'N/A' }} <span class="text-warning"><i class="fas fa-star"></i></span></h5>
                            <small class="text-muted">{{ $ratings->count() }} Ulasan</small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @forelse ($ratings as $rating)
                            <div class="review-item mb-3 p-3" style="background: var(--nb-paper); border: 1px solid var(--nb-border); border-radius: 8px;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0" style="font-family: var(--nb-font-ui); color: var(--nb-ink);">
                                        <i class="fas fa-user-circle text-primary mr-2"></i> User #{{ $rating->id_user }}
                                    </h6>
                                    <div class="text-warning" style="font-size: 0.9rem;">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}" style="opacity: {{ $i <= $rating->rating ? '1' : '0.3' }};"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.95rem; line-height: 1.6;">"{{ $rating->comment }}"</p>
                            </div>
                        @empty
                            <div class="text-center p-4">
                                <div style="font-size: 3rem; color: var(--nb-soft); margin-bottom: 1rem;"><i class="far fa-comment-dots"></i></div>
                                <p class="text-muted mb-0" style="font-size: 1.05rem;">Belum ada ulasan untuk lowongan ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Aksi & Ringkasan -->
            <div class="col-lg-4">
                <div class="card nb-card" style="background: var(--nb-surface); border: 1px solid var(--nb-border); border-radius: 12px; box-shadow: var(--nb-shadow-md); position: sticky; top: 100px;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-4">
                            <h5 style="font-family: var(--nb-font-display); font-weight: 600; color: var(--nb-ink); font-size: 1.3rem;">Tertarik dengan Pekerjaan ini?</h5>
                            <p class="text-muted" style="font-size: 0.95rem;">Jangan lewatkan kesempatan, segera kirimkan lamaran terbaik Anda!</p>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-lg w-100 mb-3" data-toggle="modal" data-target="#applyModal" style="background: var(--nb-primary); border: none; border-radius: 8px; font-weight: bold; padding: 14px; font-family: var(--nb-font-ui); box-shadow: 0 4px 6px rgba(30,58,138,0.2); transition: all 0.3s ease;">
                            <i class="fas fa-paper-plane mr-2"></i> Lamar Sekarang
                        </button>
                        
                        <a href="{{ route('user.carijob') }}" class="btn btn-outline-secondary w-100" style="border-radius: 8px; font-weight: 600; padding: 12px; font-family: var(--nb-font-ui);">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pencarian
                        </a>
                        
                        <hr style="border-color: var(--nb-border); margin: 24px 0;">
                        
                        <div class="text-left">
                            <h6 style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); margin-bottom: 15px; text-transform: uppercase; font-size: 0.85rem;">Ringkasan</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-center">
                                    <div style="width: 35px; height: 35px; background: rgba(30,58,138,0.1); color: var(--nb-primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 0.8rem; text-transform: uppercase;">Dibuat Pada</span>
                                        <span style="font-weight: 600; color: var(--nb-ink); font-size: 0.95rem;">{{ \Carbon\Carbon::parse($pekerjaan->created_at)->format('d M Y') }}</span>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div style="width: 35px; height: 35px; background: rgba(16,185,129,0.1); color: var(--nb-success); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <span class="d-block text-muted" style="font-size: 0.8rem; text-transform: uppercase;">Pendaftar</span>
                                        <span style="font-weight: 600; color: var(--nb-ink); font-size: 0.95rem;">Terbuka</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Lamar Pekerjaan -->
<div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: none; border-radius: 12px; box-shadow: var(--nb-shadow-lg);">
            <div class="modal-header" style="background: var(--nb-surface); border-bottom: 1px solid var(--nb-border); border-radius: 12px 12px 0 0; padding: 20px 24px;">
                <h5 class="modal-title fw-bold" id="applyModalLabel" style="font-family: var(--nb-font-display); color: var(--nb-ink);">
                    <i class="fas fa-file-signature text-primary mr-2"></i> Kirim Lamaran
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: var(--nb-ink); opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('carijob.lamar', $pekerjaan->id) }}" method="POST">
                @csrf
                <div class="modal-body" style="background: var(--nb-paper); padding: 24px;">
                    <div class="alert alert-info" style="background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); color: var(--nb-cyan); border-radius: 8px;">
                        <i class="fas fa-info-circle mr-2"></i> Berikan kesan pertama yang baik kepada Mitra!
                    </div>
                    <div class="form-group mb-0">
                        <label for="description" style="font-family: var(--nb-font-ui); font-weight: 600; color: var(--nb-ink);">Kenapa Anda Layak Diterima? <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Tuliskan pengalaman, keahlian, atau motivasi Anda di sini..." style="border-radius: 8px; border: 1px solid var(--nb-border); padding: 15px; resize: none;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background: var(--nb-surface); border-top: 1px solid var(--nb-border); border-radius: 0 0 12px 12px; padding: 16px 24px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background: var(--nb-primary); border: none; border-radius: 8px; font-weight: bold; padding: 10px 20px;">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Lamaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Animasi Hover Tombol Lamar */
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(30,58,138,0.3) !important;
}
/* Menghapus padding/margin extra dari list/p */
p:last-child, ul:last-child {
    margin-bottom: 0;
}
</style>
@endsection
