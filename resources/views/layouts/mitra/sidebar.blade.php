<nav class="sidebar sidebar-offcanvas" id="sidebar">  
            <ul class="nav">  
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.dashboard') ? 'active' : '' }}" href="{{ route('mitra.dashboard') }}">  
                        <i class="fas fa-home menu-icon"></i>  
                        <span class="menu-title">Dashboard</span>  
                    </a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.job') ? 'active' : '' }}" href="{{ route('mitra.job') }}">  
                        <i class="fas fa-briefcase menu-icon"></i>  
                        <span class="menu-title">Posting Pekerjaan</span>  
                    </a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.lamar') ? 'active' : '' }}" href="{{ route('mitra.lamar') }}">  
                        <i class="fas fa-file-alt menu-icon"></i>  
                        <span class="menu-title">Daftar Lamaran</span>  
                    </a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.freelance') ? 'active' : '' }}" href="{{ route('mitra.freelance') }}">  
                        <i class="fas fa-users menu-icon"></i>  
                        <span class="menu-title">Freelance</span>  
                    </a>  
                </li>
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.chat') ? 'active' : '' }}" href="{{ route('mitra.chat') }}">  
                        <i class="fas fa-comments menu-icon"></i>  
                        <span class="menu-title">Chat</span>  
                    </a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.notifications') ? 'active' : '' }}" href="{{ route('mitra.notifications') }}">  
                        <i class="fas fa-bell menu-icon"></i>  
                        <span class="menu-title">Notifikasi</span>  
                        @if ($unreadNotificationsCount > 0)  
                            <span class="badge badge-danger badge-pill unread-notifications-count">{{ $unreadNotificationsCount }}</span>  
                        @endif  
                    </a>  
                </li>  
                <li class="nav-item">  
                    <a class="nav-link {{ request()->routeIs('mitra.user') ? 'active' : '' }}" href="{{ route('mitra.user') }}">  
                        <i class="fas fa-user menu-icon"></i>  
                        <span class="menu-title">Profil Saya</span>  
                    </a>  
                </li>  
            </ul>  
        </nav> 