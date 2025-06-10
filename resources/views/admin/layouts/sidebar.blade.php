 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/index3.html" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Pakar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
            <li class="nav-item">
                <a href="/admin/diagnosa" class="nav-link {{ request()->is('admin/diagnosa*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-spinner"></i>
                <p>
                    Diagnosa
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                
            
            <li class="nav-item">
                <a href="/admin/pasien" class="nav-link {{ request()->is('admin/pasien*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Pasien
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/penyakit" class="nav-link {{ request()->is('admin/penyakit*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Penyakit
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/gejala" class="nav-link {{ request()->is('admin/gejala*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Gejala
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/admin/user" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    User
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
                </a>
            </li>
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>