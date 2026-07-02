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
                    <div class="nb-section-title" style="font-family: var(--nb-font-display); font-size: 2rem; margin-bottom: 20px;">CARI FREELANCER</div>

                    <div class="nb-card mb-4" style="background: var(--nb-surface); padding: 20px;">
                        <div class="nb-flex nb-items-center nb-justify-between" style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between;">
                            <form action="{{ route('mitra.freelance') }}" method="GET" class="nb-flex" style="display: flex; gap: 0.5rem; flex: 1;">
                                <input type="text" name="search" class="nb-input" placeholder="Cari freelancer..." value="{{ request('search') }}" style="max-width: 300px; padding: 10px; border: var(--nb-border);">
                                <button type="submit" class="nb-btn nb-btn-primary" style="background: var(--nb-primary); padding: 10px 20px; border: var(--nb-border); font-weight: bold;">CARI</button>
                            </form>
                            <div class="nb-flex" style="display: flex; gap: 0.5rem;">
                                <button class="nb-btn nb-btn-secondary" id="gridViewBtn" style="background: var(--nb-cyan); padding: 10px 20px; border: var(--nb-border); font-weight: bold;">GRID</button>
                                <button class="nb-btn nb-btn-secondary" id="listViewBtn" style="background: var(--nb-cyan); padding: 10px 20px; border: var(--nb-border); font-weight: bold;">LIST</button>
                            </div>
                        </div>
                    </div>

                    <div class="nb-grid nb-grid-4" id="freelancerGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                        @foreach($users as $user)
                        <div class="nb-user-card freelancer-card nb-card" style="background: var(--nb-surface); padding: 20px; text-align: center;">
                            <img src="{{ $user->profil_picture }}" alt="{{ $user->name }}" class="nb-avatar nb-avatar-lg" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem; border: var(--nb-border);">
                            <h4 style="font-family: var(--nb-font-display);">{{ $user->name }}</h4>
                            <div class="nb-badge" style="background: var(--nb-success); padding: 5px 10px; border: var(--nb-border); display: inline-block; font-weight: bold;">{{ $user->keahlian ?? 'Tidak ada keahlian' }}</div>
                            <p style="margin: 1rem 0; font-size: 0.875rem;">{{ Str::limit($user->deskripsi ?? 'Tidak ada deskripsi', 80) }}</p>
                            <div class="nb-flex nb-justify-center nb-gap-1" style="margin-bottom: 1rem; display: flex; justify-content: center;">
                                <span style="background: var(--nb-primary); padding: 4px 8px; border: var(--nb-border); font-weight: bold;">
                                    â­ {{ number_format($user->rating ?? 0, 1) }}
                                </span>
                            </div>
                            <div class="nb-flex nb-flex-col" style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <a href="{{ route('freelance.detail', $user->id) }}" class="nb-btn nb-btn-primary" style="background: var(--nb-cyan); padding: 10px; border: var(--nb-border); font-weight: bold; text-decoration: none; color: black;">DETAIL</a>
                                <button class="nb-btn nb-btn-success" data-bs-toggle="modal" data-bs-target="#contactModal" data-id-user="{{ $user->id }}" style="background: var(--nb-success); padding: 10px; border: var(--nb-border); font-weight: bold;">KONTAK</button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="nb-user-card freelancer-list" id="freelancerList" style="display: none; flex-direction: column; gap: 1rem; margin-bottom: 1rem;">
                        @foreach($users as $user)
                        <div class="nb-card" style="display: flex; align-items: center; gap: 1rem; width: 100%; padding: 1rem; background: var(--nb-surface);">
                            <img src="{{ $user->profil_picture }}" alt="{{ $user->name }}" class="nb-avatar" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: var(--nb-border); flex-shrink: 0;">
                            <div style="flex: 1;">
                                <h5 style="margin: 0; font-family: var(--nb-font-display);">{{ $user->name }}</h5>
                                <p style="margin: 0.25rem 0; font-size: 0.875rem; font-weight: bold;">{{ $user->keahlian ?? '-' }}</p>
                                <span style="background: var(--nb-primary); padding: 2px 6px; border: var(--nb-border); font-size: 0.75rem; font-weight: bold;">â­ {{ number_format($user->rating ?? 0, 1) }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <a href="{{ route('freelance.detail', $user->id) }}" class="nb-btn nb-btn-primary" style="background: var(--nb-cyan); padding: 0.5rem 1rem; border: var(--nb-border); font-weight: bold; text-decoration: none; color: black;">DETAIL</a>
                                <button class="nb-btn nb-btn-success" style="background: var(--nb-success); padding: 0.5rem 1rem; border: var(--nb-border); font-weight: bold;" data-bs-toggle="modal" data-bs-target="#contactModal" data-id-user="{{ $user->id }}">KONTAK</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>    
            </div>    
        </div>    
        <!-- footer -->    
        <footer class="footer">    
            <div class="d-sm-flex justify-content-center justify-content-sm-between">    
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright Â© 2024. Freelance.id. All rights reserved.</span>    
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Dibuat dengan <i class="ti-heart text-danger ml-1"></i></span>    
            </div>    
        </footer>    
    </div>    

    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content nb-card" style="background: var(--nb-surface); padding: 0;">
                <div class="modal-header" style="background: var(--nb-ink); color: white; padding: 15px 20px; border-bottom: var(--nb-border);">
                    <h5 class="modal-title" style="margin: 0; font-family: var(--nb-font-display);">KONTAK FREELANCER</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <input type="hidden" id="id_user">
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <button class="nb-btn nb-btn-primary btn-large" data-bs-toggle="modal" data-bs-target="#inviteJobModal" style="background: var(--nb-primary); width: 100%; padding: 1rem; border: var(--nb-border); font-weight: bold; font-size: 1.1rem;">Tawar Pekerjaan</button>
                        <p style="font-size: 0.85rem; margin: 0; font-weight: bold;">Ingin pekerjaan diselesaikan freelancer ini? Klik untuk menawar.</p>
                        <button class="nb-btn nb-btn-secondary btn-large" id="waChatBtn" style="background: var(--nb-cyan); width: 100%; padding: 1rem; border: var(--nb-border); font-weight: bold; font-size: 1.1rem;">Chat WhatsApp</button>
                        <p style="font-size: 0.85rem; margin: 0; font-weight: bold;">Pertanyaan umum lainnya - layanan, ketersediaan, dll.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inviteJobModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content nb-card" style="background: var(--nb-surface); padding: 0;">
                <div class="modal-header" style="background: var(--nb-ink); color: white; padding: 15px 20px; border-bottom: var(--nb-border);">
                    <h5 class="modal-title" style="margin: 0; font-family: var(--nb-font-display);">TAWAR PEKERJAAN</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <h6 style="font-weight: bold; margin-bottom: 15px;">Pekerjaan Tersedia:</h6>
                    @foreach($data as $pekerjaan)
                    <div class="nb-card mb-3" style="padding: 1rem; background: var(--nb-soft);">
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <img src="{{ $pekerjaan->foto }}" alt="{{ $pekerjaan->nama_lowongan }}" style="width: 80px; height: 80px; object-fit: cover; border: var(--nb-border);">
                            <div style="flex: 1;">
                                <h5 style="margin: 0; font-family: var(--nb-font-display);">{{ $pekerjaan->nama_lowongan }}</h5>
                                <p style="margin: 0.5rem 0; font-size: 0.875rem; font-weight: 500;">{{ Str::limit($pekerjaan->deskripsi, 60) }}</p>
                                <span style="background: var(--nb-primary); padding: 4px 8px; border: var(--nb-border); font-size: 0.75rem; font-weight: bold;">{{ $pekerjaan->jenis_lowongan }}</span>
                            </div>
                        </div>
                        <form action="{{ route('tawarkan_pekerjaan') }}" method="POST" style="margin-top: 1rem;">
                            @csrf
                            <input type="hidden" name="id_user" value="">
                            <input type="hidden" name="id_pekerjaan" value="{{ $pekerjaan->id }}">
                            <button type="submit" class="nb-btn nb-btn-primary" style="background: var(--nb-primary); width: 100%; padding: 10px; border: var(--nb-border); font-weight: bold;">Tawar Pekerjaan Ini</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.mitra.script')    
    <script>
    document.getElementById('gridViewBtn').addEventListener('click', function() {
        document.getElementById('freelancerGrid').style.display = 'grid';
        document.getElementById('freelancerList').style.display = 'none';
    });

    document.getElementById('listViewBtn').addEventListener('click', function() {
        document.getElementById('freelancerGrid').style.display = 'none';
        document.getElementById('freelancerList').style.display = 'flex';
    });

    document.querySelectorAll('.nb-btn-success').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var idUser = this.getAttribute('data-id-user');
            document.getElementById('id_user').value = idUser;
        });
    });

    $('#inviteJobModal').on('show.bs.modal', function() {
        var idUser = document.getElementById('id_user').value;
        document.querySelectorAll('#inviteJobModal input[name="id_user"]').forEach(function(input) {
            input.value = idUser;
        });
    });
    </script>
</body>    
</html>

