<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
      <i class="fab fa-laravel"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SIMPEL</div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item @if(Route::is('dashboard')) active @endif">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dasbor</span>
    </a>
  </li>

  {{--<hr class="sidebar-divider my-0">

  <li class="nav-item @if(Route::is('vechicles.*')) active @endif">
    <a class="nav-link" href="{{ route('vechicles.index') }}">
      <i class="fas fa-fw fa-truck"></i>
      <span>Data Kendaraan</span>
    </a>
  </li>--}}

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
