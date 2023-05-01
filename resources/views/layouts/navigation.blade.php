<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('front/iconsmk.png') }}" width="20px" alt="">
      </span>
      <span class="app-brand-text demo menu-text fw-bold">SKL</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->segment(1) == 'dashboard' ? 'active' : null }}">
      <a href="{{ url('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <li class="menu-item {{ request()->segment(1) == 'pengaturan' ? 'active' : null }}">
      <a href="{{ url('pengaturan') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-settings"></i>
        <div>Pengaturan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->segment(1) == 'tahun-ajaran' ? 'active' : null }}">
      <a href="{{ url('tahun-ajaran') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-calendar"></i>
        <div>Tahun Ajaran</div>
      </a>
    </li>

    <li class="menu-item {{ request()->segment(1) == 'jurusan' ? 'active' : null }}">
      <a href="{{ url('jurusan') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-affiliate"></i>
        <div>Jurusan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->segment(1) == 'data-siswa' ? 'active' : null }}">
      <a href="{{ url('data-siswa') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div>Data Siswa</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="menu-link">
        <i class="menu-icon tf-icons ti ti-logout"></i>
        <div>Logout</div>
      </a>
    </li>

  </ul>
</aside>