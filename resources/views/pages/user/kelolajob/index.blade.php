@extends('layouts.user.main')

@section('content')
<div class="content-wrapper-modern">
    <h3 class="fw-bold mb-2">Kelola Job</h3>
    <p class="text-secondary mb-4">Kelola lowongan yang sedang, pernah Anda daftar, serta statusnya.</p>

    <div class="card-modern mb-4">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Lowongan</th>
                        <th>UMKM</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lamarans as $index => $lamaran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lamaran->pekerjaan->nama_lowongan }}</td>
                            <td>
                                @if ($lamaran->mitra)
                                    {{ $lamaran->mitra->name }}
                                @else
                                    Tidak Ditemukan
                                @endif
                            </td>
                            <td class="status-{{ strtolower($lamaran->status) }}">{{ ucfirst($lamaran->status) }}</td>
                            <td>
                                @if ($lamaran->status === 'diproses')
                                    <form action="{{ route('lamaran.batalkan', $lamaran->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Batalkan</button>
                                    </form>
                                @elseif ($lamaran->status === 'ditolak')
                                    <button type="button" onclick="showModalAlasan(@json($lamaran->alasan_penolakan))" class="btn btn-secondary btn-sm">Lihat Alasan</button>
                                @elseif ($lamaran->status === 'diterima')
                                    <button type="button" onclick="showModalKetentuan(@json($lamaran->pekerjaan->ketentuan))" class="btn btn-success btn-sm">Detail</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kelolajob.detail', $lamaran->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada lamaran yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-modern">
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h4 class="fw-bold text-center mb-4">Mitra Kerja Sama</h4>
        <div class="row g-4">
            @forelse ($kerjasama as $kerja)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="job-card-modern h-100">
                        <img src="{{ asset('images/' . ($kerja->pekerjaan->foto ?? 'default.jpg')) }}" class="job-img" alt="{{ $kerja->pekerjaan->nama_lowongan }}">
                        <div class="p-3">
                            <h6 class="fw-bold">{{ $kerja->mitra->name }}</h6>
                            <p class="small fw-semibold mb-1">Lowongan: {{ $kerja->pekerjaan->nama_lowongan }}</p>
                            <p class="small text-secondary mb-3">{{ Str::limit($kerja->pekerjaan->deskripsi, 55) }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('kelolajob.terima', $kerja->id) }}" class="btn btn-success btn-sm">Terima</a>
                                <a href="{{ route('kelolajob.tolak', $kerja->id) }}" class="btn btn-danger btn-sm">Tolak</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-secondary text-center mb-0">Belum ada tawaran kerja sama.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="modal fade" id="ketentuanModal" tabindex="-1" role="dialog" aria-labelledby="ketentuanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ketentuanModalLabel">Ketentuan Lamaran dan Pekerjaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Komunikasi Langsung dengan UMKM</p>
                <p>1. Anda dapat langsung menghubungi UMKM melalui fitur chat yang telah kami sediakan di aplikasi.</p>
                <p>Tanggung Jawab Biaya dan Gaji</p>
                <p>1. Biaya, kontrak, dan pengaturan lainnya sepenuhnya menjadi tanggung jawab antara mitra dan UMKM.</p>
                <p>2. Gaji atau upah akan dibayarkan secara langsung oleh UMKM kepada mitra sesuai kesepakatan.</p>
                <p>Kunjungi Langsung Lokasi UMKM</p>
                <p>1. Anda dapat mendatangi langsung lokasi UMKM sesuai dengan alamat yang tercantum di aplikasi.</p>
                <p>Laporan Hal-hal yang Tidak Menyenangkan</p>
                <p>1. Jika Anda mengalami pengalaman yang tidak menyenangkan, segera laporkan kepada admin melalui fitur lapor.</p>
                <p>Tanggung Jawab Pekerjaan</p>
                <p>1. Pastikan Anda membaca deskripsi pekerjaan dengan teliti sebelum menyetujui tawaran kerja.</p>
                <p id="ketentuanText" class="fw-bold mt-3"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="alasanModal" tabindex="-1" role="dialog" aria-labelledby="alasanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alasanModalLabel">Alasan Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Kualifikasi Tidak Memenuhi: kualifikasi Anda belum memenuhi persyaratan yang diperlukan.</p>
                <p>Portofolio Tidak Relevan: portofolio yang Anda kirimkan tidak sepenuhnya relevan dengan kebutuhan pekerjaan.</p>
                <p>Kompetisi Tinggi: kami memilih kandidat yang lebih sesuai dengan kebutuhan saat ini.</p>
                <p>Lengkapi lagi profil dan portofolio Anda agar mitra bisa menerima Anda.</p>
                <p id="alasanText" class="fw-bold mt-3"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showModalKetentuan(ketentuan) {
        document.getElementById('ketentuanText').innerText = ketentuan || '';
        $('#ketentuanModal').modal('show');
    }

    function showModalAlasan(alasan) {
        document.getElementById('alasanText').innerText = alasan || '';
        $('#alasanModal').modal('show');
    }
</script>
@endpush
