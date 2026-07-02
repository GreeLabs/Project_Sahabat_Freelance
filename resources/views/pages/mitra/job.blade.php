<!DOCTYPE html>
<html lang="en">
<head>
    {{-- ==================== INCLUDE STYLE & ICON ==================== --}}
    @include('layouts.mitra.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- ==================== CUSTOM CSS ==================== --}}
    <style>
        .sticky-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        .banner-text {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            text-align: left;
            margin-top: 20px;
            margin-bottom: 20px;
            font-family: var(--nb-font-display);
        }
        .btn-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .image-preview {
            width: 100%;
            height: 200px;
            background-color: var(--nb-soft);
            border: var(--nb-border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-family: var(--nb-font-ui);
            font-weight: bold;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
        }
        #map {
            height: 300px;
            margin-bottom: 15px;
        }
        .page-title {
            font-family: var(--nb-font-display);
        }
    </style>
</head>

<body>
    {{-- ==================== WRAPPER UTAMA ==================== --}}
    <div class="container-scroller">

        {{-- ==================== NAVBAR & SIDEBAR ==================== --}}
        @include('layouts.mitra.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.mitra.sidebar')

            {{-- ==================== MAIN PANEL ==================== --}}
            <div class="main-panel">
                <div class="content-wrapper">

                    {{-- ========= HEADER SECTION ========= --}}
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h2 class="page-title">Pekerjaan / Lowongan</h2>
                        </div>
                    </div>

                    {{-- ========= BANNER JOB & TOMBOL TAMBAH ========= --}}
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card nb-card" style="background-color: var(--nb-surface);">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: var(--nb-border);">
                                        <img src="{{ asset('mitra/images/jobview.png') }}" alt="Ilustrasi" class="img-fluid" />
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="card-body">
                                            <h4 class="banner-text">Masukkan Lowongan/Job Anda Sekarang Disini</h4>
                                            <button class="nb-btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLowonganModal">Tambah Lowongan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ========= DAFTAR LOWONGAN YANG DITAMBAHKAN ========= --}}
                    <div class="col-12 mt-4">
                        <h2 class="page-title">Lowongan Yang Dimasukkan</h2>
                    </div>
                    <div class="row mt-4">
                        @foreach ($data as $pekerjaan)
                            <div class="col-md-4 grid-margin stretch-card">
                                <div class="card nb-card" style="background-color: var(--nb-surface);">
                                    <div class="card-body d-flex flex-column">
                                        <img src="{{ asset('images/' . $pekerjaan->foto) }}" alt="{{ $pekerjaan->nama_lowongan }}" class="img-fluid" style="height: 150px; object-fit: cover; border-radius: 4px;">
                                        <h5 class="mt-3 page-title" style="font-size: 1.25rem;">{{ $pekerjaan->nama_lowongan }}</h5>
                                        <p class="text-muted flex-grow-1" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Status: 
                                            <span style="background: {{ $pekerjaan->status == 'Aktif' ? 'var(--nb-success)' : 'var(--nb-danger)' }}; color: var(--nb-paper); padding: 4px 10px; border-radius: 4px;">
                                                {{ $pekerjaan->status }}
                                            </span>
                                        </p>
                                        <div class="d-flex justify-content-between mt-auto">
                                            <a href="{{ route('mitra.detailjob', $pekerjaan->id) }}">
                                                <button class="nb-btn btn-info">Detail</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div> {{-- END content-wrapper --}}
            </div> {{-- END main-panel --}}
        </div> {{-- END page-body-wrapper --}}

        {{-- ==================== FOOTER ==================== --}}
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                    Copyright Â© 2024. Freelance.id. All rights reserved.
                </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                    Dibuat dengan <i class="ti-heart text-danger ml-1"></i>
                </span>
            </div>
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                    Didistribusikan oleh <a href="https://www.themewagon.com/" target="_blank">Themewagon</a>
                </span>
            </div>
        </footer>

        {{-- ==================== STICKY BUTTON TAMBAH ==================== --}}
        <div class="sticky-button">
            <button class="nb-btn btn-primary" style="width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px;" data-bs-toggle="modal" data-bs-target="#tambahLowonganModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        {{-- ==================== MODAL TAMBAH LOWONGAN ==================== --}}
        <div class="modal fade" id="tambahLowonganModal" tabindex="-1" aria-labelledby="tambahLowonganModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border: var(--nb-border); box-shadow: var(--nb-shadow-lg); border-radius: 8px;">
                    <div class="modal-header" style="background: var(--nb-surface); border-bottom: var(--nb-border); border-radius: 8px;">
                        <h5 class="modal-title page-title" id="tambahLowonganModalLabel" style="font-size: 1.5rem;">Tambah Lowongan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1; font-weight: bold; font-family: var(--nb-font-display); background: none; border: none; font-size: 1.5rem;">X</button>
                    </div>
                    <div class="modal-body" style="background: var(--nb-surface); padding: 25px;">
                        {{-- ===== FORM TAMBAH LOWONGAN ===== --}}
                        <form id="lowonganForm" action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- ==== KOLOM FOTO ==== --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Tambah Foto</label>
                                        <div class="image-preview" id="imagePreview">
                                            <span>Tambah Foto</span>
                                        </div>
                                        <input type="file" class="form-control nb-input mt-2" name="foto" id="fotoInput" accept="image/*">
                                    </div>
                                </div>

                                {{-- ==== KOLOM INPUTAN ==== --}}
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="namaLowongan" class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama Lowongan</label>
                                        <input type="text" class="form-control nb-input" name="nama_lowongan" id="namaLowongan" placeholder="Masukkan nama lowongan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenisLowongan" class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Jenis Lowongan</label>
                                        <select class="form-select nb-input" name="jenis_lowongan" id="jenis_lowongan">
                                            <option value="" disabled selected>Pilih jenis lowongan</option>
                                            <option value="Food & Beverage">Food & Beverage</option>
                                            <option value="Pertanian & Perkebunan">Pertanian & Perkebunan</option>
                                            <option value="IT">IT</option>
                                            <option value="Event & Hiburan">Event & Hiburan</option>
                                            <option value="Layanan Transportasi">Layanan Transportasi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gaji" class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Gaji</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="number" name="gaji_minimal" class="form-control nb-input" placeholder="Minimal">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="gaji_maksimal" class="form-control nb-input" placeholder="Maksimal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ==== DESKRIPSI DAN PERSYARATAN ==== --}}
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Deskripsi</label>
                                <textarea class="form-control nb-input" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi lowongan"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="persyaratan" class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Persyaratan</label>
                                <textarea class="form-control nb-input" id="persyaratan" name="persyaratan" rows="4" placeholder="Masukkan Persyaratan lowongan"></textarea>
                            </div>

                            {{-- ==== LOKASI ==== --}}
                            <div class="mb-3">
                                <label for="lokasi" class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Lokasi</label>
                                <textarea class="form-control nb-input" id="lokasi" name="lokasi" rows="4" placeholder="Masukkan Lokasi Anda"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: var(--nb-border); background: var(--nb-surface);">
                        <button type="reset" class="nb-btn btn-danger" form="lowonganForm">Reset</button>
                        <button type="submit" class="nb-btn btn-success" form="lowonganForm">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== SCRIPT SECTION ==================== --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        {{-- ===== PREVIEW FOTO DINAMIS ===== --}}
        <script>
            const fotoInput = document.getElementById('fotoInput');
            const imagePreview = document.getElementById('imagePreview');

            fotoInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto" style="max-width: 100%; max-height: 100%; border-radius: 4px;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>

    {{-- ==================== SCRIPT BAWAH TAMBAHAN ==================== --}}
    @include('layouts.mitra.script')
</body>
</html>

