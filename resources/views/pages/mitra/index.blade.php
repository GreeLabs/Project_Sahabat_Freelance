<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.mitra.style')
</head>
<body>
    <div class="container-scroller">
        @include('layouts.mitra.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.mitra.sidebar')
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Welcome Banner -->
                    <div class="row mb-4">
                        <div class="col-md-12 stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface); padding: 30px; border-left: 4px solid var(--nb-primary);">
                                <div class="d-flex align-items-center h-100 justify-content-between flex-wrap">
                                    <div class="mr-4 mb-3 mb-md-0">
                                        <h2 class="mb-2" style="font-family: var(--nb-font-display); color: var(--nb-ink);">Selamat Datang, {{ Auth::guard('mitra')->user()->name }}!</h2>
                                        @if($unreadNotificationsCount > 0)
                                            <p class="mb-0" style="font-weight: 600; font-size: 1.05rem; color: var(--nb-danger);">
                                                <i class="fa-solid fa-bell"></i> Anda memiliki {{ $unreadNotificationsCount }} notifikasi baru.
                                            </p>
                                        @else
                                            <p class="mb-0 text-muted" style="font-size: 1.05rem;">Pantau aktivitas proyek dan pelamar Anda hari ini.</p>
                                        @endif
                                    </div>
                                    <img src="{{ asset('mitra/images/dashboard/people2.png') }}" alt="people" style="max-height: 140px; opacity: 0.9;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <!-- Stat 1 -->
                        <div class="col-md-3 mb-4 stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface);">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="mb-0 text-muted" style="font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Total Lowongan</p>
                                        <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(30, 58, 138, 0.1); display: flex; align-items: center; justify-content: center; color: var(--nb-primary); font-size: 1.2rem;">
                                            <i class="fa-solid fa-briefcase"></i>
                                        </div>
                                    </div>
                                    <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.25rem; color: var(--nb-ink);">{{ $totalJobs }}</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Stat 2 -->
                        <div class="col-md-3 mb-4 stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface);">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="mb-0 text-muted" style="font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Lamaran Masuk</p>
                                        <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: center; color: var(--nb-cyan); font-size: 1.2rem;">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </div>
                                    </div>
                                    <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.25rem; color: var(--nb-ink);">{{ $totalLamaran }}</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Stat 3 -->
                        <div class="col-md-3 mb-4 stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface);">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="mb-0 text-muted" style="font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Rating Rata-rata</p>
                                        <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: var(--nb-warning); font-size: 1.2rem;">
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.25rem; color: var(--nb-ink);">{{ number_format($avgRating, 1) }}</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Stat 4 -->
                        <div class="col-md-3 mb-4 stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface);">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="mb-0 text-muted" style="font-weight: 600; text-transform: uppercase; font-size: 0.8rem;">Pesan Baru</p>
                                        <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center; color: var(--nb-danger); font-size: 1.2rem;">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </div>
                                    <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.25rem; color: var(--nb-ink);">{{ $unreadMessages }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions & Recent Activity -->
                    <div class="row mb-4">
                        <div class="col-md-4 stretch-card">
                            <div class="card nb-card w-100" style="background: var(--nb-surface);">
                                <div class="card-header" style="background: transparent; padding: 18px 24px; border-bottom: 1px solid var(--nb-border);">
                                    <h5 class="mb-0" style="font-family: var(--nb-font-display); color: var(--nb-ink);">⚡ Akses Cepat</h5>
                                </div>
                                <div class="card-body p-4 d-flex flex-column gap-3">
                                    <a href="{{ route('mitra.job') }}" class="nb-btn btn-primary w-100 text-center mb-2 text-decoration-none" style="font-weight: 600;">
                                        <i class="fa-solid fa-plus mr-2"></i> Post Lowongan
                                    </a>
                                    <a href="{{ route('mitra.freelance') }}" class="nb-btn btn-outline-primary w-100 text-center mb-2 text-decoration-none" style="font-weight: 600;">
                                        <i class="fa-solid fa-search mr-2"></i> Cari Freelancer
                                    </a>
                                    <a href="{{ route('mitra.chat') }}" class="nb-btn btn-outline-secondary w-100 text-center text-decoration-none" style="font-weight: 600;">
                                        <i class="fa-solid fa-message mr-2"></i> Cek Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8 stretch-card mt-4 mt-md-0">
                            <div class="card nb-card w-100" style="background: var(--nb-surface);">
                                <div class="card-header d-flex justify-content-between align-items-center" style="background: transparent; padding: 18px 24px; border-bottom: 1px solid var(--nb-border);">
                                    <h5 class="mb-0" style="font-family: var(--nb-font-display); color: var(--nb-ink);">🔔 Lamaran Terbaru</h5>
                                    <a href="{{ route('mitra.lamar') }}" style="font-size: 0.85rem; font-weight: 600; text-decoration: none;">Lihat Semua</a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table nb-table mb-0">
                                            <thead style="background: var(--nb-soft);">
                                                <tr>
                                                    <th style="font-weight: 600; color: var(--nb-muted);">Pelamar</th>
                                                    <th style="font-weight: 600; color: var(--nb-muted);">Posisi</th>
                                                    <th style="font-weight: 600; color: var(--nb-muted);">Waktu</th>
                                                    <th style="font-weight: 600; color: var(--nb-muted);">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentLamaran as $lamaran)
                                                    <tr>
                                                        <td style="font-weight: 600; color: var(--nb-ink);">{{ $lamaran->user->name ?? 'User' }}</td>
                                                        <td>{{ $lamaran->pekerjaan->judul }}</td>
                                                        <td class="text-muted">{{ $lamaran->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <a href="{{ route('mitra.lamar') }}" class="nb-btn btn-sm btn-primary" style="padding: 6px 12px; font-size: 0.75rem;">Lihat</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center p-5">
                                                            <div style="color: var(--nb-muted); font-size: 1.5rem; margin-bottom: 10px;"><i class="fa-solid fa-inbox"></i></div>
                                                            <p class="mb-0" style="font-weight: 500; color: var(--nb-muted);">Belum ada lamaran masuk terbaru.</p>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Promo / Content Banners -->
                    @if($contents->count() > 0)
                    <div class="row mb-4">
                        @foreach ($contents as $content)
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card nb-card w-100" style="background: var(--nb-surface); padding: 0; flex-direction: row; align-items: center; overflow: hidden; flex-wrap: wrap;">
                                    <div class="p-4 p-md-5" style="flex: 1; min-width: 300px;">
                                        <h3 class="mb-3" style="font-family: var(--nb-font-display); color: var(--nb-primary);">{{ $content->title }}</h3>
                                        <p class="mb-4 text-muted" style="font-size: 1rem;">{{ $content->body }}</p>
                                        <button class="nb-btn btn-primary" style="font-size: 0.9rem; padding: 10px 20px;">{{ $content->button_name }}</button>
                                    </div>
                                    <div style="flex: 1; min-width: 300px; text-align: center; background: linear-gradient(135deg, rgba(30,58,138,0.05) 0%, rgba(30,58,138,0.1) 100%); height: 100%; min-height: 250px; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('images/' . $content->image) }}" alt="Banner Illustration" style="max-height: 200px; object-fit: contain; padding: 20px;">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                </div>
                <!-- footer -->
                <footer class="footer" style="background: var(--nb-surface); border-top: 1px solid var(--nb-border); padding: 20px;">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }}. Sahabat Freelance. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Dibuat dengan <i class="fa-solid fa-heart text-danger mx-1"></i></span>
                    </div>
                </footer>
            </div>
            
        </div>
    </div>
    @include('layouts.mitra.script')
</body>
</html>
