<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">{{ $data->nama }}</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{url('/dashboard')}}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      @if (Session::get('hak_akses') == 'mahasiswa'){
      <li class="nav-header">MAHASISWA</li>
      <li class="nav-item">
        <a href="{{url('/submission_proposal')}}" class="nav-link">
          <i class="nav-icon fas fa-hand-holding"></i>
          <p>
            Pengajuan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/guidance')}}" class="nav-link">
          <i class="nav-icon fas fa-chalkboard-teacher"></i>
          <p>
            Bimbingan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/view_schedule')}}" class="nav-link">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Jadwal Sidang
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/prasidang')}}" class="nav-link">
          <i class="nav-icon fas fa-file-contract"></i>
          <p>
            Pendaftaran Sidang
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/pascasidang')}}" class="nav-link">
          <i class="nav-icon fas fa-file-upload"></i>
          <p>
            Pengumpulan Skripsi
          </p>
        </a>
      </li>
      }
      @elseif(Session::get('hak_akses') == 'prodi'){
      <li class="nav-header">PRODI</li>
      <li class="nav-item">
        <a href="{{url('/manage_proposal')}}" class="nav-link">
          <i class="nav-icon far fa-folder-open"></i>
          <p>
            Kelola Pengajuan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/manage_grade')}}" class="nav-link">
          <i class="nav-icon far fa-file-alt"></i>
          <p>
            Kelola Nilai
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/manage_prasidang')}}" class="nav-link">
          <i class="nav-icon fas fa-archive"></i>
          <p>
            Kelola Prasidang
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/viewpasca')}}" class="nav-link">
          <i class="nav-icon fas fa-hand-holding"></i>
          <p>
            Pascasidang
          </p>
        </a>
      </li>
      }
      @elseif(Session::get('hak_akses') == 'lppm'){
      <li class="nav-header">LPPM</li>
      <li class="nav-item">
        <a href="{{url('/manage_account')}}" class="nav-link">
          <i class="nav-icon fas fa-users-cog"></i>
          <p>
            Kelola Akun
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/manage_group')}}" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
          <p>
            Kelola Kelompok
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/manage_schedule')}}" class="nav-link">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Kelola Jadwal
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/notice')}}" class="nav-link">
          <i class="nav-icon fas fa-bullhorn"></i>
          <p>
            Pengumuman
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/viewpasca')}}" class="nav-link">
          <i class="nav-icon fas fa-hand-holding"></i>
          <p>
            Pascasidang
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/grade_student')}}" class="nav-link">
          <i class="nav-icon fas fa-hand-holding"></i>
          <p>
            Lapor Nilai
          </p>
        </a>
      </li>
      }
      @elseif(Session::get('hak_akses') == 'dosen'){
      <li class="nav-header">Dosen</li>
      <li class="nav-item">
        <a href="{{url('/manage_guidance')}}" class="nav-link">
          <i class="nav-icon fas fa-chalkboard-teacher"></i>
          <p>
            Kelola Bimbingan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/view_schedule')}}" class="nav-link">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Jadwal Sidang
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/viewpasca')}}" class="nav-link">
          <i class="nav-icon fas fa-hand-holding"></i>
          <p>
            Pascasidang
          </p>
        </a>
      </li>
      }
      @endif
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->