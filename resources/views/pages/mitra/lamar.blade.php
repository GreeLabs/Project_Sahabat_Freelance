<!DOCTYPE html>    
<html lang="en">    
<head>    
    @include('layouts.mitra.style')    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">    
</head>    
<body>    
    <div class="container-scroller">    
        @include('layouts.mitra.navbar')    
        <div class="container-fluid page-body-wrapper">    
            @include('layouts.mitra.sidebar')    
            <div class="main-panel">    
                <div class="content-wrapper">    
                    <div class="row">    
                        <div class="col-12 mb-3">    
                            <h2 class="page-title">Daftar Lamaran</h2>    
                        </div>    
                    </div>    
                    <div class="col-lg-12 grid-margin stretch-card">    
                        <div class="card nb-card" style="background: var(--nb-paper);">    
                            <div class="card-body">    
                                <h4 class="card-title" style="font-size: 1.5rem;">Daftar Lamaran Yang Di Proses</h4>    
                                <p class="card-description" style="font-family: var(--nb-font-ui); font-weight: 500;">    
                                    Anda Bisa Melihat <code style="background: var(--nb-soft); padding: 2px 4px; border: var(--nb-border); border-radius: 0; color: var(--nb-ink); font-weight: bold;">Tabel Lamaran</code> Yang Di terima Dan Ditolak    
                                </p>    
                                <div class="table-responsive">    
                                    <table class="table table-bordered" style="border: var(--nb-border); background: var(--nb-surface);">    
                                        <thead style="background: var(--nb-primary); border-bottom: var(--nb-border);">    
                                            <tr>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama Pelamar</th>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Lowongan Yang Didaftar</th>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Permohonan Pelamar</th>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">CV</th>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Portofolio</th>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Aksi</th>    
                                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Status</th>    
                                            </tr>    
                                        </thead>    
                                        <tbody style="background: var(--nb-paper);">    
                                            @foreach($lamarans as $lamaran)    
                                            <tr>    
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $lamaran->name }}</td>    
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $lamaran->nama_lowongan }}</td>    
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $lamaran->deskripsiU }}</td>    
                                                <td style="border: var(--nb-border);">    
                                                    <a href="{{ asset('cvs/' . $lamaran->CV) }}" target="_blank" class="nb-btn btn-white" style="font-size: 0.875rem; text-decoration: none;">Lihat CV</a>    
                                                </td>    
                                                <td style="border: var(--nb-border);">    
                                                    <a href="{{ asset('portfolios/' . $lamaran->portofolio) }}" target="_blank" class="nb-btn btn-white" style="font-size: 0.875rem; text-decoration: none;">Lihat Portofolio</a>    
                                                </td>    
                                                <td class="action-buttons" style="border: var(--nb-border);">    
                                                    <form action="{{ route('mitra.lamar.updateStatus', $lamaran->id) }}" method="POST" style="display:inline;">    
                                                        @csrf    
                                                        @method('PUT')    
                                                        <input type="hidden" name="status" value="diterima">    
                                                        <button type="submit" class="nb-btn btn-success" style="width: 100%; margin-bottom: 5px;">Terima</button>    
                                                    </form>    
                                                    <form action="{{ route('mitra.lamar.updateStatus', $lamaran->id) }}" method="POST" style="display:inline;">    
                                                        @csrf    
                                                        @method('PUT')    
                                                        <input type="hidden" name="status" value="ditolak">    
                                                        <button type="submit" class="nb-btn btn-danger" style="width: 100%; margin-bottom: 5px;">Tolak</button>    
                                                    </form>    
                                                    <a href="{{ route('mitra.chat', ['user_id' => $lamaran->id_user]) }}" class="nb-btn btn-info w-100 mt-1" style="display: block; text-align: center; text-decoration: none;">Chat</a>    
                                                </td>    
                                                <td style="border: var(--nb-border);">    
                                                    @if($lamaran->status == 'diterima')    
                                                        <span style="background: var(--nb-success); color: var(--nb-paper); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Diterima</span>    
                                                    @elseif($lamaran->status == 'ditolak')    
                                                        <span style="background: var(--nb-danger); color: var(--nb-paper); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Ditolak</span>    
                                                    @else    
                                                        <span style="background: var(--nb-warning); color: var(--nb-ink); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Menunggu</span>    
                                                    @endif    
                                                </td>    
                                            </tr>    
                                            @endforeach    
                                        </tbody>    
                                    </table>    
                                </div>    
                            </div>    
                        </div>    
                    </div>    
                </div>    
            </div>    
        </div>    
        <!-- footer -->    
        <footer class="footer">    
            <div class="d-sm-flex justify-content-center justify-content-sm-between">    
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. Freelance.id. All rights reserved.</span>    
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Dibuat dengan <i class="ti-heart text-danger ml-1"></i></span>    
            </div>    
            <div class="d-sm-flex justify-content-center justify-content-sm-between">    
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Didistribusikan oleh <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>    
            </div>    
        </footer>    
    </div>    
    @include('layouts.mitra.script')    
</body>    
</html>    
