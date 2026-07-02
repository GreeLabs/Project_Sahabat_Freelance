<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">RemakeFreelance</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">RF</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"> 
               <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li> 
            <li class="menu-header">Manajemen</li>
            <li class="{{ request()->routeIs('admin.pengguna') ? 'active' : '' }}"> 
               <a class="nav-link" href="{{ route('admin.pengguna') }}"><i class="fas fa-users"></i> <span>Manajemen Pengguna</span></a>
            </li> 
            <li class="{{ request()->routeIs('admin.lowongan') ? 'active' : '' }}"> 
               <a class="nav-link" href="{{ route('admin.lowongan') }}"><i class="fas fa-briefcase"></i> <span>Manajemen Lowongan</span></a>
            </li> 
            <li class="{{ request()->routeIs('admin.notifikasi') ? 'active' : '' }}"> 
               <a class="nav-link" href="{{ route('admin.notifikasi') }}"><i class="fas fa-bell"></i> <span>Manajemen Notifikasi</span></a>
            </li> 
            <li class="{{ request()->routeIs('admin.services') ? 'active' : '' }}"> 
               <a class="nav-link" href="{{ route('admin.services') }}"><i class="fas fa-cogs"></i> <span>Manajemen Layanan</span></a>
            </li> 
            <li class="{{ request()->routeIs('admin.konten') ? 'active' : '' }}">
               <a class="nav-link" href="{{ route('admin.konten') }}"><i class="fas fa-file-alt"></i> <span>Manajemen Konten</span></a>
            </li> 
        </ul>
    </aside>
</div>
