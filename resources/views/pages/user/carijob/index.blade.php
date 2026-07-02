@extends('layouts.user.main')

@section('content')
<div class="content-wrapper-modern">
    <h3 class="fw-bold mb-4">Cari Lowongan</h3>

    <div class="d-flex flex-wrap justify-content-center mb-4">
        <a href="{{ route('user.carijob') }}" class="nb-btn mr-2 mb-2 {{ $kategori == null ? 'nb-btn-primary' : 'nb-btn-secondary' }}">Semua</a>
        <a href="{{ route('user.carijob', ['kategori' => 'Food & Beverage']) }}" class="nb-btn mr-2 mb-2 {{ $kategori == 'Food & Beverage' ? 'nb-btn-primary' : 'nb-btn-secondary' }}">Food & Beverage</a>
        <a href="{{ route('user.carijob', ['kategori' => 'Pertanian & Perkembangan']) }}" class="nb-btn mr-2 mb-2 {{ $kategori == 'Pertanian & Perkembangan' ? 'nb-btn-primary' : 'nb-btn-secondary' }}">Pertanian</a>
        <a href="{{ route('user.carijob', ['kategori' => 'IT']) }}" class="nb-btn mr-2 mb-2 {{ $kategori == 'IT' ? 'nb-btn-primary' : 'nb-btn-secondary' }}">IT</a>
        <a href="{{ route('user.carijob', ['kategori' => 'Event & Hiburan']) }}" class="nb-btn mr-2 mb-2 {{ $kategori == 'Event & Hiburan' ? 'nb-btn-primary' : 'nb-btn-secondary' }}">Event</a>
        <a href="{{ route('user.carijob', ['kategori' => 'Layanan Transportasi']) }}" class="nb-btn mr-2 mb-2 {{ $kategori == 'Layanan Transportasi' ? 'nb-btn-primary' : 'nb-btn-secondary' }}">Transportasi</a>
        <button class="nb-btn nb-btn-secondary mb-2" data-toggle="modal" data-target="#sortModal">
            <i class="fas fa-filter"></i> Filter
        </button>
    </div>

    <div class="row g-4">
        @forelse($pekerjaans as $pekerjaan)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="job-card-modern h-100">
                    <img src="{{ $pekerjaan->foto }}" class="job-img" alt="{{ $pekerjaan->nama_lowongan }}">
                    <div class="p-3">
                        <span class="nb-badge nb-badge-primary mb-2">{{ $pekerjaan->jenis_lowongan }}</span>
                        <h6 class="fw-bold">{{ $pekerjaan->nama_lowongan }}</h6>
                        <p class="small text-secondary mb-2">{{ Str::limit($pekerjaan->deskripsi, 60) }}</p>
                        <p class="small fw-semibold mb-3">Rp{{ number_format($pekerjaan->gaji_minimal, 0, ',', '.') }} - Rp{{ number_format($pekerjaan->gaji_maksimal, 0, ',', '.') }}</p>
                        <a href="{{ route('carijob.detail', $pekerjaan->id) }}" class="nb-btn nb-btn-primary w-100">Lamar!</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-modern text-center py-5">
                    <h4 class="fw-bold mb-2">Tidak Ada Lowongan</h4>
                    <p class="text-secondary mb-0">Tidak ada pekerjaan yang tersedia pada kategori ini.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($pekerjaans->hasPages())
    <div class="nb-pagination mt-4">
        {{ $pekerjaans->links() }}
    </div>
    @endif

    <div class="modal fade" id="sortModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: var(--nb-white);">
                <div class="modal-header" style="background: var(--nb-black); color: var(--nb-white);">
                    <h5 class="modal-title">Filter Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sortForm" action="{{ route('user.carijob') }}" method="GET">
                        @if($kategori)
                            <input type="hidden" name="kategori" value="{{ $kategori }}">
                        @endif
                        <div class="nb-form-group">
                            <label class="nb-label">Urutkan:</label>
                            <select class="nb-select" name="sort">
                                <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="lowest" {{ $sort == 'lowest' ? 'selected' : '' }}>Termurah</option>
                                <option value="highest" {{ $sort == 'highest' ? 'selected' : '' }}>Termahal</option>
                            </select>
                        </div>
                        <div class="nb-form-group">
                            <label class="nb-label">Gaji Min:</label>
                            <input type="number" class="nb-input" name="minCost" placeholder="Min Cost" value="{{ $minCost ?? '' }}">
                        </div>
                        <div class="nb-form-group">
                            <label class="nb-label">Gaji Max:</label>
                            <input type="number" class="nb-input" name="maxCost" placeholder="Max Cost" value="{{ $maxCost ?? '' }}">
                        </div>
                        <div class="nb-form-group">
                            <label class="nb-label">Cari Skill:</label>
                            <input type="text" class="nb-input" name="skillSearch" placeholder="Ketik skill..." value="{{ $skillSearch ?? '' }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 3px solid var(--nb-black);">
                    <button type="button" class="nb-btn nb-btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" form="sortForm" class="nb-btn nb-btn-primary">Terapkan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
