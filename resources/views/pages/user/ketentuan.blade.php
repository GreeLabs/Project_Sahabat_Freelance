@extends('layouts.user.main')

@section('content')
<div class="content-wrapper-modern">
    <section class="header-section mb-4">
        <span class="nb-badge mb-3">Panduan</span>
        <h1 class="page-title mb-3">Ketentuan dan Persyaratan</h1>
        <p class="mb-0">Baca panduan penggunaan Sahabat Freelance agar proses kerja antara pengguna, mitra UMKM, dan admin tetap jelas.</p>
    </section>

    <div class="terms-layout">
        <aside class="terms-index card-modern">
            <h2 class="mb-3">Isi Panduan</h2>
            <nav aria-label="Navigasi ketentuan">
                <a href="#penerimaan">Penerimaan</a>
                <a href="#definisi">Definisi</a>
                <a href="#akun">Pendaftaran dan Akun</a>
                <a href="#pengguna">Kewajiban Pengguna</a>
                <a href="#mitra">Kewajiban Mitra</a>
                <a href="#admin">Hak Admin</a>
                <a href="#pembayaran">Pembayaran</a>
                <a href="#data">Data Pribadi</a>
                <a href="#tanggung-jawab">Tanggung Jawab</a>
                <a href="#perubahan">Perubahan</a>
            </nav>
        </aside>

        <article class="terms-content card-modern">
            <section id="penerimaan" class="terms-section">
                <span class="nb-badge">01</span>
                <h2>Penerimaan Persyaratan</h2>
                <p>Dengan mendaftar, mengakses, atau menggunakan aplikasi Sahabat Freelance, Anda dianggap telah membaca, memahami, dan menyetujui semua ketentuan yang ditetapkan di bawah ini. Jika Anda tidak menyetujui salah satu ketentuan, harap tidak melanjutkan penggunaan aplikasi ini.</p>
            </section>

            <section id="definisi" class="terms-section">
                <span class="nb-badge">02</span>
                <h2>Definisi</h2>
                <ul>
                    <li>Sahabat Freelance: Platform yang mempertemukan pengguna freelance, mitra UMKM, dan admin untuk mendukung kegiatan freelance berbasis digital.</li>
                    <li>Pengguna: Individu yang terdaftar sebagai freelance dalam aplikasi.</li>
                    <li>Mitra UMKM: Pelaku usaha kecil dan menengah yang mencari jasa freelance melalui aplikasi.</li>
                    <li>Admin: Pengelola aplikasi yang memastikan operasional berjalan sesuai ketentuan.</li>
                </ul>
            </section>

            <section id="akun" class="terms-section">
                <span class="nb-badge">03</span>
                <h2>Pendaftaran dan Akun</h2>
                <ul>
                    <li>Pengguna wajib memberikan informasi pribadi yang akurat, terkini, dan lengkap selama proses pendaftaran.</li>
                    <li>Pengguna bertanggung jawab menjaga kerahasiaan akun dan kata sandi. Segala aktivitas melalui akun adalah tanggung jawab pemilik akun.</li>
                    <li>Penggunaan akun untuk tujuan ilegal atau tidak etis akan berujung pada penangguhan atau penghapusan akun.</li>
                </ul>
            </section>

            <section id="pengguna" class="terms-section">
                <span class="nb-badge">04</span>
                <h2>Kewajiban Pengguna</h2>
                <ul>
                    <li>Mematuhi semua hukum dan peraturan yang berlaku.</li>
                    <li>Tidak menggunakan platform untuk menyebarkan konten diskriminatif, pornografi, kekerasan, atau pelanggaran hak cipta.</li>
                    <li>Menghindari tindakan penipuan, termasuk memberikan informasi palsu atau tidak sah.</li>
                </ul>
            </section>

            <section id="mitra" class="terms-section">
                <span class="nb-badge">05</span>
                <h2>Kewajiban Mitra UMKM</h2>
                <ul>
                    <li>Memberikan deskripsi pekerjaan yang jelas, termasuk lingkup tugas, tenggat waktu, dan kompensasi yang ditawarkan.</li>
                    <li>Membayar freelance sesuai kesepakatan setelah pekerjaan selesai.</li>
                    <li>Tidak melakukan pelecehan atau diskriminasi terhadap pengguna freelance.</li>
                </ul>
            </section>

            <section id="admin" class="terms-section">
                <span class="nb-badge">06</span>
                <h2>Hak dan Kewajiban Admin</h2>
                <ul>
                    <li>Admin berhak menghapus atau menangguhkan akun yang melanggar ketentuan.</li>
                    <li>Admin bertanggung jawab memantau aktivitas dalam aplikasi untuk memastikan kepatuhan terhadap persyaratan dan ketentuan.</li>
                    <li>Admin tidak bertanggung jawab atas perselisihan antara pengguna dan mitra UMKM, namun dapat menjadi mediator jika diperlukan.</li>
                </ul>
            </section>

            <section id="pembayaran" class="terms-section">
                <span class="nb-badge">07</span>
                <h2>Sistem Pembayaran</h2>
                <ul>
                    <li>Pembayaran dilakukan melalui metode yang disediakan dalam aplikasi, seperti e-wallet, transfer bank, atau metode lain yang sesuai.</li>
                    <li>Setiap transaksi akan dikenakan biaya administrasi sesuai kebijakan yang berlaku.</li>
                    <li>Sahabat Freelance tidak bertanggung jawab atas kesalahan pembayaran di luar sistem aplikasi.</li>
                </ul>
            </section>

            <section id="data" class="terms-section">
                <span class="nb-badge">08</span>
                <h2>Penggunaan Data Pribadi</h2>
                <ul>
                    <li>Data pengguna akan digunakan sesuai dengan Kebijakan Privasi Sahabat Freelance.</li>
                    <li>Informasi yang dikumpulkan meliputi data pendaftaran, aktivitas di aplikasi, dan data transaksi.</li>
                    <li>Sahabat Freelance berkomitmen melindungi data pribadi pengguna sesuai undang-undang yang berlaku.</li>
                </ul>
            </section>

            <section id="tanggung-jawab" class="terms-section">
                <span class="nb-badge">09</span>
                <h2>Batasan Tanggung Jawab</h2>
                <ul>
                    <li>Sahabat Freelance tidak bertanggung jawab atas kerugian yang diakibatkan oleh kelalaian pengguna.</li>
                    <li>Platform hanya menyediakan layanan perantara antara pengguna dan mitra UMKM.</li>
                </ul>
            </section>

            <section id="perubahan" class="terms-section">
                <span class="nb-badge">10</span>
                <h2>Perubahan Ketentuan</h2>
                <ul>
                    <li>Sahabat Freelance berhak mengubah atau memperbarui Persyaratan dan Ketentuan ini sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</li>
                    <li>Pengguna disarankan untuk memeriksa halaman ini secara berkala untuk mengetahui pembaruan terbaru.</li>
                </ul>
            </section>

            <section class="terms-section mb-0">
                <span class="nb-badge">11</span>
                <h2>Penutup</h2>
                <p>Dengan terus menggunakan aplikasi Sahabat Freelance, Anda setuju untuk mematuhi semua syarat dan ketentuan yang berlaku.</p>
            </section>
        </article>
    </div>
</div>
@endsection
