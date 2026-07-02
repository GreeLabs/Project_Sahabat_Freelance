@extends('layouts.user.main')

@section('content')
<div class="content-wrapper-modern">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.kelolajob') }}">Kelola Job</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $pekerjaan->nama_lowongan ?? 'Detail' }}</li>
        </ol>
    </nav>

    <div class="card-modern mb-4">
        <h2 class="fw-bold text-center mb-4">Detail Lowongan</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <img src="{{ asset('images/' . ($pekerjaan->foto ?? 'default.jpg')) }}" class="job-img w-100" alt="{{ $pekerjaan->nama_lowongan ?? 'Lowongan' }}">
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold">{{ $pekerjaan->nama_lowongan ?? 'Tidak Ditemukan' }}</h4>
                <p class="mb-2"><strong>Jenis Lowongan:</strong> {{ $pekerjaan->jenis_lowongan ?? 'Tidak Ditemukan' }}</p>
                <p class="mb-2"><strong>Gaji:</strong> Rp{{ number_format($pekerjaan->gaji_minimal ?? 0, 0, ',', '.') }} - Rp{{ number_format($pekerjaan->gaji_maksimal ?? 0, 0, ',', '.') }}</p>
                <p class="mb-2"><strong>Lokasi:</strong> {{ $pekerjaan->lokasi ?? 'Tidak Ditemukan' }}</p>
                <p class="mb-2"><strong>Status:</strong>
                    <span class="badge badge-{{ $lamaran ? strtolower($lamaran->status) : 'secondary' }}">
                        {{ $lamaran ? ucfirst($lamaran->status) : 'Belum Dalam Proses' }}
                    </span>
                </p>
                <p class="mb-1"><strong>Deskripsi:</strong></p>
                <p class="mb-0">{{ $pekerjaan->deskripsi ?? 'Tidak Ditemukan' }}</p>
            </div>
        </div>
    </div>

    <div class="card-modern mb-4">
        <h4 class="fw-bold mb-3">Rating dan Komentar</h4>
        <div class="row g-4">
            <div class="col-md-4">
                <h5>Rating Rata-rata: {{ $pekerjaan->mitra_rating ?? 'Belum ada rating' }}/5</h5>
                <p class="mb-0">Jumlah Ulasan: {{ $ratings->count() }}</p>
            </div>
            <div class="col-md-8">
                @forelse ($ratings as $rating)
                    <div class="card-modern mb-3 p-3">
                        <h6 class="fw-bold mb-1">User #{{ $rating->id_user }}</h6>
                        <p class="mb-1">Rating: {{ $rating->rating }}/5</p>
                        <p class="mb-0 text-secondary">{{ $rating->comment }}</p>
                    </div>
                @empty
                    <p class="text-secondary mb-0">Belum ada ulasan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card-modern">
        <h4 class="fw-bold mb-3">Beri Rating</h4>
        <form action="{{ route('pekerjaan.rate', $pekerjaan->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="rating">Rating:</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="">Pilih Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="comment">Komentar:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
            </div>
            <button type="submit" class="nb-btn nb-btn-primary">Kirim Rating</button>
        </form>
    </div>
</div>
@endsection
