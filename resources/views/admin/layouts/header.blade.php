<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <div class="d-flex align-items-center">
              <p class="m-0 p-0">{{ auth()->user()->email }}</p>
              <a class="nav-link" href="/logout" role="button">
                  <i class="fas fa-sign-out-alt"></i>
              </a>
          </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
