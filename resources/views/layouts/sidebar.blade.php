<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Vehicle</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item @if(Route::is('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dasbor</span>
        </a>
    </li>

    @can('view-any', \App\Models\Travel::class)
        <li class="nav-item @if(Route::is('travels.*')) active @endif">
            <a class="nav-link" href="{{ route('travels.index') }}">
                <i class="fas fa-fw fa-route"></i>
                <span>Data Perjalanan</span>
            </a>
        </li>
    @endcan

    @can('view-any', \App\Models\Driver::class)
        <li class="nav-item @if(Route::is('drivers.*')) active @endif">
            <a class="nav-link" href="{{ route('drivers.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Driver</span>
            </a>
        </li>
    @endcan

    @can('view-any', \App\Models\Vehicle::class)
        <li class="nav-item @if(Route::is('vehicles.*')) active @endif">
            <a class="nav-link" href="{{ route('vehicles.index') }}">
                <i class="fas fa-fw fa-truck-pickup"></i>
                <span>Data Kendaraan</span>
            </a>
        </li>
    @endcan

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
