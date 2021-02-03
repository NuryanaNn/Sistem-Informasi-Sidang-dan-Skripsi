<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-warning navbar-light bg-gradient-warning">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{url('/dashboard')}}" class="nav-link">Beranda</a>
    </li>
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <img src="" alt=""><i class="fas fa-user-circle"></i>
        <span>{{ Session::get('username') }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
        <a href="{{url('/profile')}}" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Profil
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('logout')}}" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->