<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Masuk atau daftar ke Sahabat Freelance.' }}">
    <title>{{ $title ?? 'Sahabat Freelance' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IBM+Plex+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/css/neo-brutalism.css', 'resources/css/auth.css'])
    @stack('styles')
</head>
<body class="auth-page">
    <a class="skip-link" href="#auth-content">Lewati ke formulir</a>

    <div class="auth-marquee" aria-hidden="true">
        <div class="auth-marquee-track">
            @for ($repeat = 0; $repeat < 2; $repeat++)
                <span>Talenta lokal</span>
                <span>Proyek berkualitas</span>
                <span>Pembayaran aman</span>
                <span>Kolaborasi lebih mudah</span>
            @endfor
        </div>
    </div>

    <main class="auth-shell" id="auth-content" tabindex="-1">
        <aside class="auth-brand-panel" aria-label="Tentang Sahabat Freelance">
            <a class="auth-brand" href="{{ url('/') }}">
                <span class="auth-brand-mark" aria-hidden="true">SF</span>
                <span>Sahabat Freelance</span>
            </a>

            <div class="auth-brand-content">
                <span class="auth-eyebrow">Platform freelance untuk UMKM</span>
                <h1 class="auth-brand-title">KERJA. TUMBUH. <strong>BERSAMA.</strong></h1>
                <p class="auth-brand-copy">Temukan proyek, kelola talenta, dan bangun kolaborasi yang jelas dari awal sampai selesai.</p>

                <ul class="auth-proof-list">
                    <li><i class="bi bi-shield-check" aria-hidden="true"></i> Akun dan transaksi lebih terlindungi</li>
                    <li><i class="bi bi-briefcase" aria-hidden="true"></i> Proyek untuk berbagai keahlian</li>
                    <li><i class="bi bi-people" aria-hidden="true"></i> Mitra dan freelancer dalam satu platform</li>
                </ul>
            </div>

            <p class="auth-brand-footer">Sahabat Freelance &copy; {{ date('Y') }}</p>
        </aside>

        <section class="auth-form-panel">
            @yield('content')
        </section>
    </main>
    @include('components.toastr')
    @include('sweetalert::alert')
    @stack('scripts')
</body>
</html>
