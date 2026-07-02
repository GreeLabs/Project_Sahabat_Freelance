<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sahabat Freelance menghubungkan freelancer, talenta lokal, dan mitra UMKM dalam satu platform.">
    <title>Sahabat Freelance | Marketplace Talenta Profesional</title>
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>

<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <div class="container">
            <a class="nav-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-briefcase"></i>
                Sahabat<span>Freelance</span>
            </a>
            <div class="nav-links">
                <a href="#kategori">Kategori</a>
                <a href="#proyek">Proyek Terbaru</a>
                <a href="#keunggulan">Keunggulan</a>
                <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Temukan Talenta Terbaik<br>Untuk <span>Proyek Anda</span></h1>
            <p class="hero-subtitle">Platform marketplace terpercaya yang menghubungkan UMKM dengan freelancer profesional di seluruh Indonesia. Cepat, aman, dan transparan.</p>
            
            <div class="search-box">
                <input type="text" placeholder="Cari keahlian (mis: Desain Web, Penulis, Admin)...">
                <button class="btn btn-accent"><i class="fa-solid fa-search"></i> Temukan Talenta</button>
            </div>
            
            <div style="margin-top: 32px; color: var(--color-muted); font-size: 0.9rem;">
                <strong>Pencarian Populer:</strong> Web Developer, UI/UX Design, Social Media Admin, Logo Design
            </div>
        </div>
    </section>

    <!-- ===== CATEGORIES ===== -->
    <section class="section" id="kategori" style="background: #FFFFFF;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Kategori Keahlian</h2>
                <p style="color: var(--color-muted);">Jelajahi berbagai layanan profesional yang siap membantu bisnis Anda tumbuh.</p>
            </div>
            
            <div class="categories-grid">
                <div class="category-card">
                    <i class="fa-solid fa-code category-icon"></i>
                    <h3>Web & App Development</h3>
                    <p>Website, Aplikasi Mobile, Software</p>
                </div>
                <div class="category-card">
                    <i class="fa-solid fa-pen-nib category-icon"></i>
                    <h3>Desain Grafis</h3>
                    <p>Logo, Branding, Ilustrasi, UI/UX</p>
                </div>
                <div class="category-card">
                    <i class="fa-solid fa-bullhorn category-icon"></i>
                    <h3>Digital Marketing</h3>
                    <p>SEO, Sosial Media, Ads, Konten</p>
                </div>
                <div class="category-card">
                    <i class="fa-solid fa-video category-icon"></i>
                    <h3>Video & Animasi</h3>
                    <p>Editing, Motion Graphics, Intro</p>
                </div>
                <div class="category-card">
                    <i class="fa-solid fa-keyboard category-icon"></i>
                    <h3>Penulisan & Penerjemahan</h3>
                    <p>Artikel, Copywriting, Dokumen</p>
                </div>
                <div class="category-card">
                    <i class="fa-solid fa-chart-line category-icon"></i>
                    <h3>Bisnis & Konsultasi</h3>
                    <p>Keuangan, Legal, Manajemen</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURED JOBS ===== -->
    <section class="section" id="proyek">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Proyek Pilihan</h2>
                <p style="color: var(--color-muted);">Ratusan proyek baru ditambahkan setiap minggunya.</p>
            </div>
            
            <div class="featured-grid">
                <!-- Job Card 1 -->
                <div class="job-card">
                    <img src="/images/c.jpg" alt="Proyek Web" class="job-image" onerror="this.src='https://placehold.co/400x200/F8FAFC/1E3A8A?text=Proyek+UMKM'">
                    <div class="job-content">
                        <div class="job-rating"><i class="fa-solid fa-star"></i> Proyek Terverifikasi</div>
                        <h3 class="job-title">Pembuatan Website E-Commerce Toko Baju</h3>
                        <p class="job-desc">Mencari developer untuk membuat toko online dengan fitur payment gateway otomatis dan manajemen inventaris untuk UMKM lokal.</p>
                        <div class="job-footer">
                            <span class="job-price">Rp 3.500.000</span>
                            <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.875rem;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Job Card 2 -->
                <div class="job-card">
                    <img src="/images/a.jpg" alt="Proyek Desain" class="job-image" onerror="this.src='https://placehold.co/400x200/F8FAFC/1E3A8A?text=Proyek+Desain'">
                    <div class="job-content">
                        <div class="job-rating"><i class="fa-solid fa-star"></i> Proyek Terverifikasi</div>
                        <h3 class="job-title">Branding Kedai Kopi Kekinian</h3>
                        <p class="job-desc">Butuh desainer untuk membuat logo, desain kemasan cup, dan materi promosi sosial media untuk pembukaan kedai kopi baru.</p>
                        <div class="job-footer">
                            <span class="job-price">Rp 1.200.000</span>
                            <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.875rem;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <!-- Job Card 3 -->
                <div class="job-card">
                    <img src="/images/b.jpg" alt="Proyek Marketing" class="job-image" onerror="this.src='https://placehold.co/400x200/F8FAFC/1E3A8A?text=Proyek+Marketing'">
                    <div class="job-content">
                        <div class="job-rating"><i class="fa-solid fa-star"></i> Proyek Terverifikasi</div>
                        <h3 class="job-title">Manajemen Akun Instagram Restoran</h3>
                        <p class="job-desc">Mencari admin sosial media yang bisa membuat konten plan, desain post, dan mengelola interaksi selama 1 bulan penuh.</p>
                        <div class="job-footer">
                            <span class="job-price">Rp 2.000.000</span>
                            <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.875rem;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 48px;">
                <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 16px 32px; font-size: 1.1rem;">Jelajahi Lebih Banyak Proyek</a>
            </div>
        </div>
    </section>

    <!-- ===== TRUST SECTION ===== -->
    <section class="trust-section" id="keunggulan">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Mengapa Memilih Kami?</h2>
                <p style="opacity: 0.9;">Platform karya anak bangsa yang fokus memajukan UMKM dan Talenta Lokal.</p>
            </div>
            
            <div class="trust-grid">
                <div class="trust-item">
                    <h3>100%</h3>
                    <p>Pembayaran Aman Tersistem</p>
                </div>
                <div class="trust-item">
                    <h3>+1.3k</h3>
                    <p>UMKM Bergabung</p>
                </div>
                <div class="trust-item">
                    <h3>4.9/5</h3>
                    <p>Rating Rata-rata Kepuasan</p>
                </div>
                <div class="trust-item">
                    <h3>24/7</h3>
                    <p>Dukungan Bantuan Teknis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CALL TO ACTION ===== -->
    <section class="section" style="background: #E0E7FF; text-align: center;">
        <div class="container">
            <h2 class="section-title" style="margin-bottom: 24px;">Siap Mengembangkan Bisnis Anda?</h2>
            <p style="font-size: 1.1rem; color: var(--color-muted); max-width: 600px; margin: 0 auto 32px auto;">Bergabunglah dengan ribuan UMKM dan freelancer lainnya yang telah sukses berkolaborasi di platform kami.</p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sebagai Mitra</a>
                <a href="{{ route('register') }}" class="btn btn-outline" style="background: #FFFFFF;">Jadi Freelancer</a>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a class="nav-brand" href="{{ url('/') }}" style="color: #FFFFFF; margin-bottom: 24px;">
                        <i class="fa-solid fa-briefcase" style="color: var(--color-accent);"></i>
                        Sahabat<span style="color: var(--color-secondary);">Freelance</span>
                    </a>
                    <p style="color: #94A3B8;">Mempermudah koneksi, menyelesaikan proyek, dan mengembangkan bisnis UMKM dengan cara yang lebih modern dan aman.</p>
                    <div style="display: flex; gap: 16px; margin-top: 24px; font-size: 1.25rem;">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h5>Platform</h5>
                    <ul class="footer-links">
                        <li><a href="#proyek">Cari Proyek</a></li>
                        <li><a href="#kategori">Keahlian</a></li>
                        <li><a href="#">Cara Kerja</a></li>
                        <li><a href="#">Harga</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h5>Tentang Kami</h5>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h5>Bantuan & Dukungan</h5>
                    <ul class="footer-links">
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">Kebijakan Keamanan</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2026 Sahabat Freelance. Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>
    @include('components.toastr')
    @include('sweetalert::alert')
</body>
</html>
