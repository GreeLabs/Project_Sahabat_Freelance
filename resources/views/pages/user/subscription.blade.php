@extends('layouts.user.main')

@section('title', 'Langganan Premium')

@section('content')
<div class="content-wrapper-modern py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold" style="font-family: var(--nb-font-display);">Pilih Paket Langganan</h2>
                <p class="text-secondary">Akses eksklusif ke proyek UMKM pilihan untuk mengembangkan karirmu.</p>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-5">
                <div class="card nb-card h-100 p-4 text-center" style="background: var(--nb-surface); border: var(--nb-border); border-radius: 0;">
                    <h3 class="fw-bold text-primary mb-2">Paket Plus</h3>
                    <h2 class="fw-bold mb-4" style="font-family: var(--nb-font-display);">Rp 45.000 <small class="fs-6 fw-normal text-muted">/tahun</small></h2>
                    
                    <ul class="list-unstyled text-start mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Akses lamar 50+ proyek per bulan</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Prioritas di pencarian UMKM</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Support email</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pembayaran via Transfer Bank</li>
                    </ul>

                    <a href="https://app.midtrans.com/payment-links/1736255879076" target="_blank" class="nb-btn btn-primary w-100">Lanjutkan Pembayaran</a>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card nb-card h-100 p-4 text-center" style="background: var(--nb-surface); border: var(--nb-border); border-radius: 0;">
                    <div class="badge bg-warning text-dark position-absolute top-0 end-0 m-3 fw-bold" style="border: 2px solid #111;">TERLARIS</div>
                    
                    <h3 class="fw-bold text-warning mb-2">Paket Pro</h3>
                    <h2 class="fw-bold mb-4" style="font-family: var(--nb-font-display);">Rp 75.000 <small class="fs-6 fw-normal text-muted">/selamanya</small></h2>
                    
                    <ul class="list-unstyled text-start mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Akses lamar proyek UNLIMITED</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Lencana Pro di profilmu</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Support WhatsApp prioritas</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pembayaran via Transfer Bank</li>
                    </ul>

                    <a href="https://app.midtrans.com/payment-links/1736255740644" target="_blank" class="nb-btn btn-warning w-100">Lanjutkan Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
