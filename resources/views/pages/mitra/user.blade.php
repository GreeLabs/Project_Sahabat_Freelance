<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.mitra.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .header {
            background-color: var(--nb-surface);
            padding: 20px;
            border: var(--nb-border);
            border-radius: 0;
            box-shadow: 8px 8px 0px var(--nb-ink);
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-image {
            position: relative;
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-image img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: var(--nb-border);
        }
        .profile-info {
            flex-grow: 1;
        }
        .profile-info h3 {
            font-size: 1.5rem;
            font-weight: bold;
            font-family: var(--nb-font-display);
        }
        .rating {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            gap: 10px;
        }
        .tab {
            padding: 10px 20px;
            background-color: var(--nb-soft);
            border: var(--nb-border);
            cursor: pointer;
            text-align: center;
            flex-grow: 1;
            font-family: var(--nb-font-ui);
            font-weight: bold;
            text-transform: uppercase;
        }
        .tab.active {
            background-color: var(--nb-primary);
            color: var(--nb-ink);
            box-shadow: 4px 4px 0px var(--nb-ink);
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-weight: bold;
            font-family: var(--nb-font-ui);
        }
        .info-item i {
            margin-right: 10px;
            color: var(--nb-ink);
        }
        .project-card-container {  
            display: flex;  
            flex-direction: column;  
            gap: 15px;
        }  
        .project-card {  
            background-color: var(--nb-paper);  
            border: var(--nb-border);
            border-radius: 0;  
            padding: 15px;  
            display: flex;  
            justify-content: space-between;  
            align-items: center;  
            box-shadow: 4px 4px 0px var(--nb-ink);
        }  
        .project-header {  
            display: flex;  
            justify-content: space-between;  
            width: 100%;  
        }  
        .project-title {  
            font-weight: bold;  
            font-size: 1.2rem;  
            font-family: var(--nb-font-display);
        }  
        .project-status {  
            padding: 5px 10px;  
            border: var(--nb-border);
            color: var(--nb-paper);  
            font-weight: bold;  
            text-transform: uppercase;
            font-size: 0.8rem;
        }  
        .project-status.active {  
            background-color: var(--nb-success); 
        }  
        .project-status.completed {  
            background-color: var(--nb-ink); 
        }  
        .project-details {  
            display: flex;  
            align-items: center;  
            justify-content: space-between;  
            width: 100%;  
            margin-top: 10px;
        }  
        .premium-card-container {  
            display: flex;  
            justify-content: space-between;  
            gap: 20px; 
        }  
        .premium-card {  
            background-color: var(--nb-soft);  
            border: var(--nb-border);
            padding: 20px;  
            flex: 1;
            box-shadow: 6px 6px 0px var(--nb-ink);  
            text-align: center;  
        }  
        .premium-card h5 {
            font-family: var(--nb-font-display);
            font-size: 1.5rem;
        }
        .logout-container {  
            text-align: right;
        }  
        .tab-content {
            display: none; 
        }
        .tab-content.active {
            display: block; 
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: var(--nb-surface);
            padding: 20px;
            border: var(--nb-border);
            border-radius: 0;
            box-shadow: 8px 8px 0px var(--nb-ink);
            text-align: center;
            max-width: 600px;
        }
        .modal-content img {
            width: 100%;
            height: auto;
            border: var(--nb-border);
            border-radius: 0;
            object-fit: cover;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        @include('layouts.mitra.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.mitra.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Header -->
                    <div class="header">
                    <div class="profile-image" id="openModal">
                            <img src="{{ asset('images/' . $mitra->profil_picture) }}" alt="Profile Picture">
                        </div>
                        <div class="profile-info">
                            <h3>{{ $mitra->name }}</h3>
                            <p style="font-weight: bold; font-family: var(--nb-font-ui);">{{ $mitra->email }}</p>
                        </div>
                    </div>

                    <!-- Tabs Navigation -->
                    <div class="tabs">
                        <div class="tab active" data-tab="account-info">Informasi Akun</div>
                        <div class="tab" data-tab="job-listings">Lowongan</div>
                        <div class="tab" data-tab="reviews">Review</div>
                        <div class="tab" data-tab="edit-profile">Edit Profil</div>
                        <div class="tab" data-tab="help">Bantuan</div>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content active" id="account-info">  
                        <div class="card nb-card" style="background: var(--nb-paper);">  
                            <h4 style="font-family: var(--nb-font-display);">Informasi Akun</h4>  
                            <div class="info-item">  
                                <i class="fas fa-envelope"></i>  
                                <span>Email: {{ $mitra->email }}</span>   
                            </div>  
                            <div class="info-item">  
                                <i class="fas fa-phone"></i>  
                                <span>Nomor Telepon: {{ $mitra->nohp }}</span>  
                            </div>  
                            <div class="info-item">  
                                <i class="fas fa-credit-card"></i>  
                                <span>Langganan : <span style="background: var(--nb-primary); padding: 2px 6px; border: var(--nb-border); text-transform: uppercase;">{{ $mitra->role }}</span></span>  
                            </div>  
                        </div>  
                    
                        <div class="card nb-card mt-4" style="background: var(--nb-paper);">  
                            <h4 style="font-family: var(--nb-font-display);">Paket Langganan Premium</h4>  
                            <div class="premium-card-container">  
                                <div class="premium-card" style="background: var(--nb-warning);">  
                                    <h5>Premium Pro</h5>  
                                    <p style="font-weight: 500;">Fitur lengkap untuk kebutuhan profesional.</p>  
                                    <p style="background: var(--nb-paper); border: var(--nb-border); padding: 5px; font-family: var(--nb-font-ui);"><strong>Harga: Rp 75.000/Selamanya</strong></p>  
                                    <a href="https://app.midtrans.com/payment-links/1736255740644" style="text-decoration: none;"><button class="nb-btn btn-primary w-100">Langganan Sekarang</button></a>
                                </div>  
                                <div class="premium-card" style="background: var(--nb-cyan);">  
                                    <h5>Premium Lite</h5>  
                                    <p style="font-weight: 500;">Fitur dasar untuk pengguna biasa.</p>  
                                    <p style="background: var(--nb-paper); border: var(--nb-border); padding: 5px; font-family: var(--nb-font-ui);"><strong>Harga: Rp 45.000/Setahun</strong></p>  
                                    <a href="https://app.midtrans.com/payment-links/1736255879076" style="text-decoration: none;"><button class="nb-btn btn-primary w-100">Langganan Sekarang</button> </a> 
                                </div>  
                            </div>  
                        </div>  
                    
                        <div class="logout-container mt-4">  
                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nb-btn btn-danger" style="padding: 10px 30px; font-size: 1.1rem;">Logout</button>
                            </form>
                        </div>  
                    </div>  
  

                    <div class="tab-content" id="job-listings">  
                        <div class="card nb-card" style="background: var(--nb-paper);">  
                            <h4 class="card-title" style="font-family: var(--nb-font-display);">Manajemen Lowongan</h4>  
                            <div class="project-card-container">  
                                @foreach ($kerjasama as $kerja)  
                                    <div class="project-card flex-column align-items-start">  
                                        <div class="project-header">  
                                            <span class="project-title">Proyek {{ $kerja->id_pekerjaan }}</span>  
                                            <span class="project-status active">Diterima</span>  
                                        </div>  
                                        <div class="project-details">  
                                            <span style="font-weight: bold;">User: {{ $kerja->id_user }}</span>  
                                            <a href="{{ route('mitra.detailjob', $kerja->id_pekerjaan) }}" class="nb-btn btn-info btn-sm">Lihat Detail</a>  
                                        </div>  
                                    </div>  
                                @endforeach  
  
                                @foreach ($lamarans as $lamaran)  
                                    <div class="project-card flex-column align-items-start">  
                                        <div class="project-header">  
                                            <span class="project-title">Proyek {{ $lamaran->id_pekerjaan }}</span>  
                                            <span class="project-status active">Diterima</span>  
                                        </div>  
                                        <div class="project-details">  
                                            <span style="font-weight: bold;">User: {{ $lamaran->id_user }}</span>  
                                            <a href="{{ route('mitra.detailjob', $lamaran->id_pekerjaan) }}" class="nb-btn btn-info btn-sm">Lihat Detail</a>  
                                        </div>  
                                    </div>  
                                @endforeach  
                            </div>  
                        </div>  
                    </div> 

                    <div class="tab-content" id="reviews">
                        <div class="card nb-card" style="background: var(--nb-paper);">
                            <h4 style="font-family: var(--nb-font-display);">Review & Rating</h4>    
                            <div class="row mt-3">    
                                <div class="col-md-4">    
                                    <div style="background: var(--nb-soft); border: var(--nb-border); padding: 15px; margin-bottom: 20px;">
                                        <h5 style="font-weight: bold;">Rating Rata-rata: {{ $mitra->rating ?? 'Belum ada rating' }}/5</h5>    
                                        <p style="font-family: var(--nb-font-ui); font-weight: bold;">Jumlah Ulasan: {{ $ratings->count() }}</p>    
                                    </div>
                                    <img src="{{ asset('images/feature.png') }}" class="img-fluid" alt="Alt Features" style="border: var(--nb-border);">  
                                </div>    
                                <div class="col-md-8">    
                                    @foreach ($ratings as $rating)    
                                        <div class="card nb-card mb-3" style="background: var(--nb-surface);">    
                                            <div class="card-body">    
                                                <h6 style="font-family: var(--nb-font-display);">User: {{ $rating->id_user }}</h6>    
                                                <p class="rating" style="background: var(--nb-primary); border: var(--nb-border); padding: 5px; display: inline-block; font-weight: bold;">Rating: {{ $rating->rating }}/5</p>    
                                                <p style="font-weight: 500; margin-top: 10px;">Komentar: {{ $rating->comment }}</p>     
                                            </div>    
                                        </div>    
                                    @endforeach    
                                </div>  
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="edit-profile">
                        <div class="card nb-card" style="background: var(--nb-paper);">
                            <h4 style="font-family: var(--nb-font-display);">Edit Profil</h4>
                            <form action="{{ route('mitra.updateProfile') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <div class="form-group">
                                    <label for="name" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama</label>
                                    <input type="text" class="form-control nb-input" id="name" name="name" value="{{ $mitra->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Email</label>
                                    <input type="email" class="form-control nb-input" id="email" name="email" value="{{ $mitra->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nohp" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">No Hp</label>
                                    <input type="tel" class="form-control nb-input" id="nohp" name="nohp" value="{{ $mitra->nohp }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="profil_picture" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Foto Profil</label>
                                    <input type="file" class="form-control-file nb-input" id="profil_picture" name="profil_picture">
                                </div>
                                <button type="submit" class="nb-btn btn-primary" style="padding: 10px 20px; font-size: 1.1rem;">Perbarui Profil</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-content" id="help">
                        <div class="card nb-card" style="background: var(--nb-paper);">
                            <h4 style="font-family: var(--nb-font-display);">Bantuan dan Dukungan</h4>
                            <ul style="font-weight: 500; font-family: var(--nb-font-ui); margin-top: 15px; margin-bottom: 25px;">
                                <li>Anda Bisa Dapatkan bantuan lewat bot Wa Admin</li>
                                <li>Anda Bisa Menghubungi admin lewat Wa terkait masalah pembayaran dan laporan</li>
                            </ul>
                            <a href="https://wa.me/+6285389043924" style="text-decoration: none;"><button class="nb-btn btn-danger" style="padding: 15px 30px; font-size: 1.2rem;">Hubungi Admin</button></a>
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
        </div>
    </div>
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <h4 style="font-family: var(--nb-font-display); margin-bottom: 20px; text-align: left;">Foto Profil</h4>
            <img src="{{ asset('images/' . $mitra->profil_picture) }}" alt="Profile Picture">
            <button class="nb-btn btn-secondary w-100" id="closeModal">Tutup</button>
        </div>
    </div>
    @include('layouts.mitra.script')

    <script>
        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to the clicked tab and corresponding content
                tab.classList.add('active');
                const activeTabContent = document.getElementById(tab.getAttribute('data-tab'));
                activeTabContent.classList.add('active');
            });
        });

        // Modal functionality
        const modal = document.getElementById('profileModal');
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');

        openModal.addEventListener('click', () => {
            modal.classList.add('active');
        });

        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        // Tutup modal saat klik di luar konten modal
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    </script>
</body>
</html>
