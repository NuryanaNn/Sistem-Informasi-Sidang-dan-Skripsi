<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
@include('part/css')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('part/navbar')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link bg-warning">
        <img src="{{asset('dist/img/logo.png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SISDS</span>
      </a>
      @include('part/sidebar')
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @yield('breadcrumb')
      <!-- /.content-header -->
      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
    <!-- /.content-wrapper -->
    @include('part/footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  @include('part/js')
  @stack('js')
</body>

</html>