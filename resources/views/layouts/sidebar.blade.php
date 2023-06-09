<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
    <div class="sidebar-brand-icon rotate-n-15">
      {{-- logo section --}}
      <i class=""></i>
    </div>
    <div class="sidebar-brand-text mx-3 text-uppercase">Balakara Sharade </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>DASHBOARD</span>
    </a>
  </li>

  <!-- Nav Item - Student Registration -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('products') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>STUDENT REGISTRATION</span>
    </a>
    <!-- Submenus for Student Registration -->
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('nursery') }}">Nursery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('lkg') }}">LKG</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('ukg') }}">UKG</a>
      </li>
    </ul>
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
