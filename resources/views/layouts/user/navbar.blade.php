<nav class="navbar-modern fixed-top">
    <div class="navbar-container">
        {{-- Logo --}}
        <a class="navbar-brand-modern" href="{{ route('user.dashboard') }}">
            <img src="{{ asset('mitra/images/logo.svg') }}" alt="Sahabat Freelance" class="brand-logo">
            <img src="{{ asset('mitra/images/logo-mini.svg') }}" alt="Logo" class="brand-logo-mini">
        </a>

        {{-- Search (opsional) --}}
        <div class="navbar-search d-none d-lg-block">
            <div class="search-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Cari proyek, freelancer...">
            </div>
        </div>

        <div class="navbar-menu">
            <ul class="navbar-nav-modern">
                <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.carijob', 'carijob.detail') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.carijob') }}">Cari Job</a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.kelolajob', 'kelolajob.detail') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.kelolajob') }}">Kelola Job</a>
                </li>

                {{-- Notifikasi --}}
                <li class="nav-item dropdown">
                    <a class="nav-link notification-bell" href="#" id="notificationDropdown" data-toggle="dropdown" aria-label="Buka notifikasi" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        @if(isset($notifications) && $notifications->count() > 0)
                            <span class="notification-badge">{{ $notifications->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-modern dropdown-menu-right" aria-labelledby="notificationDropdown">
                        <div class="dropdown-header">Notifikasi Terbaru</div>
                        @if(isset($notifications) && $notifications->count() > 0)
                            @foreach($notifications as $notification)
                                <a class="dropdown-item" href="#">
                                    <div class="notification-icon bg-{{ $notification->jenis == 'success' ? 'success' : ($notification->jenis == 'warning' ? 'warning' : 'primary') }}">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="notification-content">
                                        <p class="mb-0">{{ $notification->isi_pesan }}</p>
                                        <small>{{ $notification->updated_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="dropdown-item text-center text-muted py-3">Belum ada notifikasi</div>
                        @endif
                    </div>
                </li>

                {{-- Profile Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link profile-trigger dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown" aria-label="Buka menu akun" aria-haspopup="true" aria-expanded="false">
                        @php
                            $profilePictureName = $user->profil_picture;
                            $profilePicturePath = public_path('images/' . $profilePictureName);
                            $profilePicture = (!$profilePictureName || !file_exists($profilePicturePath))
                                ? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=7c3aed&color=fff'
                                : asset('images/' . $profilePictureName);
                        @endphp
                        <img src="{{ $profilePicture }}" alt="{{ $user->name }}" class="avatar-sm">
                        <span class="d-none d-lg-inline ml-2">{{ $user->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-modern dropdown-menu-right" aria-labelledby="profileDropdown">
                        <div class="dropdown-profile-header">
                            <img src="{{ $profilePicture }}" alt="profile" class="avatar-md">
                            <div>
                                <h6 class="mb-0">{{ $user->name }}</h6>
                                <small>{{ $user->email }}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="far fa-user-circle"></i> Kelola Akun
                        </a>
                        <a class="dropdown-item" href="{{ route('user.ketentuan') }}">
                            <i class="far fa-file-alt"></i> Panduan
                        </a>
                        <div class="dropdown-subscription-info">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Status: <span class="badge-status">{{ $user->status }}</span></span>
                                <span><i class="fas fa-coins"></i> {{ $user->point }} pts</span>
                            </div>
                            <a href="{{ route('user.payment') }}" class="btn-upgrade btn-sm mt-2 text-center text-decoration-none d-block">Upgrade</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger" style="background: none; border: none; width: 100%; text-align: left;">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
