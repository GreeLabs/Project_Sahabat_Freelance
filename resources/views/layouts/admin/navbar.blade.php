<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg" style="color: var(--nb-ink); border: 2px solid transparent; padding: 8px 12px;"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="display: inline-flex; align-items: center; border: 2px solid transparent; color: var(--nb-ink);">
            <img alt="image" src="{{ asset('assets/templates/admin/img/avatar/avatar-1.png') }}" class="rounded-circle mr-2" style="width: 32px; height: 32px; border: 2px solid var(--nb-ink); border-radius: 0 !important; box-shadow: 2px 2px 0 var(--nb-ink);">
            <div class="d-sm-none d-lg-inline-block" style="font-family: var(--nb-font-ui); font-weight: bold;">Hi, Admin</div></a>
            <div class="dropdown-menu dropdown-menu-right" style="border: var(--nb-border); border-radius: 0; box-shadow: var(--nb-shadow-md); padding: 0; margin-top: 10px;">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger" style="font-family: var(--nb-font-ui); font-weight: bold; padding: 12px 20px; display: flex; align-items: center; background: none; border: none; width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt mr-2" style="margin-top: 0;"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
