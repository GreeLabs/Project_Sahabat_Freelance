<nav class="navbar p-0 fixed-top d-flex flex-row" style="border-bottom: var(--nb-border-strong) !important; background: var(--nb-surface); box-shadow: 0 4px 0 var(--nb-ink); flex-wrap: nowrap; z-index: 1030; height: var(--nb-nav-height, 76px);">  
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: var(--nb-primary); border-right: var(--nb-border-strong); width: 260px; min-width: 260px; height: 100%;">  
        <a class="navbar-brand brand-logo mr-5" href="{{ route('mitra.dashboard') }}"><img src="{{ asset('mitra/images/logo.svg') }}" class="mr-2" alt="Freelance.id logo" style="max-height: 40px;"/></a>  
        <a class="navbar-brand brand-logo-mini" href="{{ route('mitra.dashboard') }}" style="display: none;"><img src="{{ asset('mitra/images/logo-mini.svg') }}" alt="Freelance.id logo" style="max-height: 30px;"/></a>  
    </div>  
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between" style="background: var(--nb-surface); flex-grow: 1; padding: 0 20px; height: 100%;">  
        <!-- Search bar dihapus karena tidak difungsikan (sesuai instruksi: hapus jika dekoratif) -->
        <div class="nav-search d-none d-lg-flex align-items-center" style="flex-grow: 1;"></div>

        <div class="d-flex align-items-center ml-auto">  
            <div class="nav-item">
                <span class="nav-profile-name ms-3 mr-3" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">{{ auth('mitra')->user()->name ?? 'Mitra' }}</span>  
            </div>  
            <div class="nav-item dropdown">  
                <a class="nav-link dropdown-toggle d-flex align-items-center p-0" href="#" data-toggle="dropdown" id="profileDropdown" style="border: 2px solid transparent;"> 
                    <img src="{{ asset('images/' . (auth('mitra')->user()->profil_picture ?? 'default.png')) }}" alt="profile" style="width: 40px; height: 40px; border: var(--nb-border); border-radius: 0; box-shadow: 2px 2px 0 var(--nb-ink); object-fit: cover;"/>  
                </a>  
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown" style="border: var(--nb-border); border-radius: 0; box-shadow: var(--nb-shadow-md); padding: 0; margin-top: 15px; min-width: 200px; position: absolute;">  
                    <a href="{{ route('mitra.user') }}" class="dropdown-item" style="font-family: var(--nb-font-ui); font-weight: bold; padding: 12px 20px; display: flex; align-items: center; color: var(--nb-ink);">  
                        <i class="ti-settings text-primary mr-2" style="font-size: 1.2rem;"></i>  
                        Pengaturan  
                    </a>  
                    <div class="dropdown-divider" style="margin: 0; border-top: var(--nb-border);"></div>
                    <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-family: var(--nb-font-ui); font-weight: bold; padding: 12px 20px; display: flex; align-items: center; color: var(--nb-ink);">  
                        <i class="ti-power-off text-danger mr-2" style="font-size: 1.2rem;"></i>  
                        Keluar  
                    </a>  
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">  
                        @csrf  
                    </form>  
                </div>  
            </div>  
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas" style="border: var(--nb-border); background: var(--nb-primary); box-shadow: 2px 2px 0 var(--nb-ink); padding: 5px 10px; margin-left: 15px; height: 40px;">  
                <span class="icon-menu" style="color: var(--nb-ink); font-weight: bold;"></span>  
            </button>  
        </div>  
    </div>  
</nav>
