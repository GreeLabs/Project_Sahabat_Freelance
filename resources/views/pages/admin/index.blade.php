@extends('layouts.admin.main') 
@section('title', 'Admin Dashboard') 
@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header mb-4" style="border: 1px solid var(--nb-border); border-radius: 8px; background: var(--nb-surface); padding: 20px; box-shadow: var(--nb-shadow-sm); border-left: 4px solid var(--nb-primary);"> 
                <h2 class="page-title mb-0" style="margin: 0; color: var(--nb-ink); font-size: 1.8rem;">Dashboard Admin</h2> 
            </div> 
            
            <div class="row g-4 mb-4"> 
                <!-- Stat 1 -->
                <div class="col-lg-4 col-md-6 col-sm-12"> 
                    <div class="card nb-card h-100" style="background: var(--nb-surface);"> 
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="mr-4" style="width: 60px; height: 60px; border-radius: 12px; background: rgba(30, 58, 138, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--nb-primary);"> 
                                <i class="far fa-user"></i> 
                            </div> 
                            <div> 
                                <h5 class="mb-1 text-muted" style="text-transform: uppercase; margin-bottom: 5px; font-size: 0.85rem; font-weight: 600;">Total Pekerja (User)</h5> 
                                <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.2rem; margin: 0; color: var(--nb-ink);">{{ $userCount }}</h2> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
                
                <!-- Stat 2 -->
                <div class="col-lg-4 col-md-6 col-sm-12"> 
                    <div class="card nb-card h-100" style="background: var(--nb-surface);"> 
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="mr-4" style="width: 60px; height: 60px; border-radius: 12px; background: rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--nb-cyan);"> 
                                <i class="far fa-newspaper"></i> 
                            </div> 
                            <div> 
                                <h5 class="mb-1 text-muted" style="text-transform: uppercase; margin-bottom: 5px; font-size: 0.85rem; font-weight: 600;">Total Lowongan</h5> 
                                <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.2rem; margin: 0; color: var(--nb-ink);">{{ $pekerjaanCount }}</h2> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
                
                <!-- Stat 3 -->
                <div class="col-lg-4 col-md-6 col-sm-12"> 
                    <div class="card nb-card h-100" style="background: var(--nb-surface);"> 
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="mr-4" style="width: 60px; height: 60px; border-radius: 12px; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: var(--nb-danger);"> 
                                <i class="fas fa-briefcase"></i> 
                            </div> 
                            <div> 
                                <h5 class="mb-1 text-muted" style="text-transform: uppercase; margin-bottom: 5px; font-size: 0.85rem; font-weight: 600;">Total Klien (Mitra)</h5> 
                                <h2 class="mb-0" style="font-family: var(--nb-font-display); font-size: 2.2rem; margin: 0; color: var(--nb-ink);">{{ $mitraCount }}</h2> 
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div> 

            <div class="row mb-4">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="card nb-card chart-container h-100" style="padding: 0; background: var(--nb-surface);">
                        <div class="card-header" style="background: transparent; padding: 20px 24px; border-bottom: 1px solid var(--nb-border);">
                            <h5 class="mb-0" style="margin: 0; font-family: var(--nb-font-display); color: var(--nb-ink);">📈 Tren Pertumbuhan (7 Bulan Terakhir)</h5>
                        </div>
                        <div class="card-body" style="padding: 24px; position: relative; height: 350px; width: 100%;">
                            <canvas id="transactionChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card nb-card h-100" style="padding: 0; background: var(--nb-surface);">
                        <div class="card-header" style="background: transparent; padding: 20px 24px; border-bottom: 1px solid var(--nb-border);">
                            <h5 class="mb-0" style="margin: 0; font-family: var(--nb-font-display); color: var(--nb-ink);">🆕 Pendaftar Terbaru</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table nb-table mb-0">
                                    <thead style="background: var(--nb-soft);">
                                        <tr>
                                            <th style="font-weight: 600; color: var(--nb-muted);">Nama User</th>
                                            <th style="font-weight: 600; color: var(--nb-muted);">Bergabung</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentUsers as $recentUser)
                                            <tr>
                                                <td style="font-weight: 600; color: var(--nb-ink);">{{ $recentUser->name }}</td>
                                                <td class="text-muted" style="font-size: 0.85rem;">
                                                    {{ $recentUser->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center p-4 text-muted">Belum ada user</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card nb-card" style="padding: 0; background: var(--nb-surface);">
                        <div class="card-header" style="background: transparent; padding: 20px 24px; border-bottom: 1px solid var(--nb-border);">
                            <h5 class="mb-0" style="margin: 0; font-family: var(--nb-font-display); color: var(--nb-ink);">📌 Lowongan Terbaru</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table nb-table mb-0">
                                    <thead style="background: var(--nb-soft);">
                                        <tr>
                                            <th style="font-weight: 600; color: var(--nb-muted);">Posisi</th>
                                            <th style="font-weight: 600; color: var(--nb-muted);">Klien (Mitra)</th>
                                            <th style="font-weight: 600; color: var(--nb-muted);">Tipe</th>
                                            <th style="font-weight: 600; color: var(--nb-muted);">Waktu Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentJobs as $job)
                                            <tr>
                                                <td style="font-weight: 600; color: var(--nb-ink);">{{ $job->judul }}</td>
                                                <td>{{ $job->mitra->name ?? 'N/A' }}</td>
                                                <td><span class="badge" style="background: var(--nb-soft); color: var(--nb-primary); border: 1px solid var(--nb-primary); border-radius: 4px; padding: 5px 10px;">{{ $job->tipe }}</span></td>
                                                <td class="text-muted" style="font-size: 0.85rem;">{{ $job->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center p-4 text-muted">Belum ada lowongan terbaru</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('transactionChart').getContext('2d');
        const transactionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'User Baru',
                    data: {!! json_encode($userData) !!},
                    borderColor: 'transparent',
                    backgroundColor: 'rgba(30, 58, 138, 0.85)',
                    borderWidth: 0,
                    borderRadius: 4,
                    barPercentage: 0.6
                }, {
                    label: 'Lowongan Baru',
                    data: {!! json_encode($jobData) !!},
                    borderColor: 'transparent',
                    backgroundColor: 'rgba(56, 189, 248, 0.85)',
                    borderWidth: 0,
                    borderRadius: 4,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748B', font: { family: "'Open Sans', sans-serif" } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#E2E8F0', borderDash: [5, 5] },
                        border: { display: false },
                        ticks: { color: '#64748B', font: { family: "'Open Sans', sans-serif", stepSize: 1 } }
                    }
                },
                plugins: {
                    legend: {
                        labels: { color: '#0F172A', font: { family: "'Open Sans', sans-serif", weight: '600' } }
                    },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        titleFont: { family: "'Open Sans', sans-serif" },
                        bodyFont: { family: "'Open Sans', sans-serif" },
                        padding: 10,
                        cornerRadius: 8
                    }
                }
            }
        });
    </script>
@endsection
