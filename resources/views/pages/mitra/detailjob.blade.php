<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Lowongan</title>
    @include('layouts.mitra.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">    
</head>
<body>
    <div class="container-scroller">
        @include('layouts.mitra.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.mitra.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <button class="nb-btn btn-white" onclick="window.history.back();" style="padding: 10px 20px;">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface); padding: 30px;">
                                <div class="row">
                                    <div class="col-md-5 mb-4 mb-md-0">
                                        <img src="{{ asset('images/' . $pekerjaan->foto) }}" alt="Lowongan" class="img-fluid w-100" style="border: var(--nb-border); max-height: 400px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-7 d-flex flex-column">
                                        <h2 class="mb-3" style="font-family: var(--nb-font-display); font-size: 3rem;">{{ $pekerjaan->nama_lowongan }}</h2>
                                        
                                        <div class="mb-3">
                                            <span style="background: var(--nb-primary); padding: 5px 12px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">{{ $pekerjaan->jenis_lowongan }}</span>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h4 style="font-family: var(--nb-font-display);">Deskripsi</h4>
                                            <p style="font-size: 1.05rem;">{{ $pekerjaan->deskripsi }}</p>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h4 style="font-family: var(--nb-font-display);">Persyaratan</h4>
                                            <p style="font-size: 1.05rem;">{{ $pekerjaan->persyaratan }}</p>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h4 style="font-family: var(--nb-font-display);">Lokasi</h4>
                                            <p style="font-size: 1.05rem;">
                                                <i class="fas fa-map-marker-alt text-danger mr-2"></i>{{ $pekerjaan->lokasi }}
                                            </p>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h4 style="font-family: var(--nb-font-display);">Gaji</h4>
                                            <p style="font-family: var(--nb-font-ui); font-size: 1.5rem; font-weight: bold;">Rp {{ number_format($pekerjaan->gaji_minimal, 0, ',', '.') }} - Rp {{ number_format($pekerjaan->gaji_maksimal, 0, ',', '.') }}</p>
                                        </div>
                                        
                                        <div class="d-flex flex-wrap mt-auto pt-4 border-top" style="border-color: var(--nb-ink) !important;">
                                            <button class="nb-btn btn-warning mr-3 mb-3" data-bs-toggle="modal" data-bs-target="#tambahLowonganModal">
                                                <i class="fas fa-edit mr-2"></i>Edit Lowongan
                                            </button>
                                            <form action="{{ route('mitra.nonaktifjob', $pekerjaan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin Menonaktifkan lowongan ini?');" class="mb-3">
                                                @csrf
                                                <button type="submit" class="nb-btn btn-danger">
                                                    <i class="fas fa-power-off mr-2"></i>Non Aktifkan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <footer class="footer" style="border-top: var(--nb-border);">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. Freelance.id. All rights reserved.</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="tambahLowonganModal" tabindex="-1" aria-labelledby="tambahLowonganModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: var(--nb-border); box-shadow: 8px 8px 0px var(--nb-ink); border-radius: 0;">
                <div class="modal-header" style="background: var(--nb-primary); border-bottom: var(--nb-border); border-radius: 0;">
                    <h5 class="modal-title" id="tambahLowonganModalLabel" style="font-family: var(--nb-font-display); font-size: 1.8rem; margin: 0;">Edit Lowongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1; font-weight: bold;">X</button>
                </div>
                <div class="modal-body" style="background: var(--nb-paper); padding: 30px;">
                    <form id="LowonganForm" action="{{ route('mitra.updatejob', $pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Edit Foto</label>
                                <div id="imagePreview" style="width: 100%; height: 200px; border: var(--nb-border); background: #eee; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 10px;">
                                    @if($pekerjaan->foto)
                                        <img src="{{ asset('images/' . $pekerjaan->foto) }}" alt="Foto Lowongan" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </div>
                                <input type="file" class="form-control nb-input" name="foto" id="fotoInput" accept="image/*">
                                <small class="text-muted d-block mt-2">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama Lowongan</label>
                                    <input type="text" class="form-control nb-input" name="nama_lowongan" value="{{ $pekerjaan->nama_lowongan }}" placeholder="Masukkan nama lowongan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Jenis Lowongan</label>
                                    <select class="form-select nb-input" name="jenis_lowongan">
                                        <option value="" disabled {{ !$pekerjaan->jenis_lowongan ? 'selected' : '' }}>Pilih jenis lowongan</option>
                                        <option value="Food & Beverage" {{ $pekerjaan->jenis_lowongan == 'Food & Beverage' ? 'selected' : '' }}>Food & Beverage</option>
                                        <option value="Pertanian & Perkebunan" {{ $pekerjaan->jenis_lowongan == 'Pertanian & Perkebunan' ? 'selected' : '' }}>Pertanian & Perkebunan</option>
                                        <option value="IT" {{ $pekerjaan->jenis_lowongan == 'IT' ? 'selected' : '' }}>IT</option>
                                        <option value="Event & Hiburan" {{ $pekerjaan->jenis_lowongan == 'Event & Hiburan' ? 'selected' : '' }}>Event & Hiburan</option>
                                        <option value="Layanan Transportasi" {{ $pekerjaan->jenis_lowongan == 'Layanan Transportasi' ? 'selected' : '' }}>Layanan Transportasi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Gaji</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-2 mb-md-0">
                                            <input type="number" name="gaji_minimal" class="form-control nb-input" value="{{ $pekerjaan->gaji_minimal }}" placeholder="Minimal">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="gaji_maksimal" class="form-control nb-input" value="{{ $pekerjaan->gaji_maksimal }}" placeholder="Maksimal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Deskripsi</label>
                            <textarea class="form-control nb-input" name="deskripsi" rows="4">{{ $pekerjaan->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Persyaratan</label>
                            <textarea class="form-control nb-input" name="persyaratan" rows="4">{{ $pekerjaan->persyaratan }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Lokasi</label>
                            <textarea class="form-control nb-input" name="lokasi" rows="2">{{ $pekerjaan->lokasi }}</textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 pt-3 border-top" style="border-color: var(--nb-ink) !important;">
                            <button type="button" class="nb-btn btn-white mr-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="nb-btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> 
    <script>
        // Preview Foto
        const fotoInput = document.getElementById('fotoInput');
        const imagePreview = document.getElementById('imagePreview');

        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto" style="width: 100%; height: 100%; object-fit: cover;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    @include('layouts.mitra.script')
</body>
</html>
