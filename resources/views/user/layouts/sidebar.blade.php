 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/index3.html" class="brand-link">
      <i class="fas fa-stethoscope brand-image elevation-3" style="opacity: .8; margin-top: 0;"></i>
      <span class="brand-text font-weight-light">Sistem Pakar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="/user/diagnosa" class="nav-link {{ request()->is('user/diagnosa') ? 'active' : '' }}">
                <i class="nav-icon fas fa-medkit"></i>
                <p>
                    Diagnosa
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/user/diagnosa/riwayat" class="nav-link {{ request()->is('user/diagnosa/riwayat') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        Riwayat Diagnosa
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
