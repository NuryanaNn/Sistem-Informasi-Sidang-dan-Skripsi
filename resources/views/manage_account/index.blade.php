@extends('layout/main')
@section('title','Manage Account')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Kelola Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Kelola Akun</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#mahasiswa" data-toggle="tab">Mahasiswa</a></li>
              <li class="nav-item"><a class="nav-link" href="#dosen" data-toggle="tab">Dosen</a></li>
              <li class="nav-item"><a class="nav-link" href="#prodi" data-toggle="tab">Prodi</a></li>
              <li class="nav-item"><a class="nav-link" href="#lppm" data-toggle="tab">LPPM</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="mahasiswa">
                <div class="row">
                  <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ route('student.create')}}" class="btn btn-primary modal-show"
                          title="Tambah Data">Tambah</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Jurusan</th>
                              <th>No Hp</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Jurusan</th>
                              <th>No Hp</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="dosen">
                <div class="row">
                  <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ route('lecturer.create')}}" class="btn btn-primary modal-show"
                          title="Tambah Data">Tambah</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="example2" class="table table-bordered table-striped" style="width: 100%;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="prodi">
                <div class="row">
                  <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ route('department.create')}}" class="btn btn-primary modal-show"
                          title="Tambah Data">Tambah</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="example3" class="table table-bordered table-striped" style="width: 100%;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>Jurusan</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>Jurusan</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="lppm">
                <div class="row">
                  <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ route('institution.create')}}" class="btn btn-primary modal-show"
                          title="Tambah Data">Tambah</a>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive">
                        <table id="example4" class="table table-bordered table-striped" style="width: 100%;">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NIDN</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No</th>
                              <th>NIDN</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>Aksi</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
  @include('layout/_modal')
</section>
@endsection
@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable({
      responsive : true,
      processing : true,
      serverSide : true,
      order: [[1, 'asc']],
        ajax: {
            'url':"{{route('table.student')}}",
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
      columns: [
        {data: 'DT_RowIndex', name:'nim'},
        {data: 'nama', name:'nama'},
        {data: 'email', name:'email'},
        {data: 'jurusan', name:'jurusan'},
        {data: 'no_hp', name:'no_hp'},
        {data: 'action', name: 'action'}
      ],
      columnDefs: [
        {
          "targets": [0, -1],
          "orderable": false,
          "searchable" : true
        }
      ]
      
    });
  });
</script>
<script>
  $(function () {
    $('#example2').DataTable({
      responsive : true,
      processing : true,
      serverSide : true,
      order: [[1, 'asc']],
        ajax: {
            'url':"{{route('table.lecturer')}}",
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
      columns: [
        {data: 'DT_RowIndex', name:'nidn'},
        {data: 'nama', name:'nama'},
        {data: 'email', name:'email'},
        {data: 'alamat', name:'alamat'},
        {data: 'action', name: 'action'}
      ],
      columnDefs: [
        {
          "targets": [0, -1],
          "orderable": false,
          "searchable" : false
        }
      ]
      
    });
  });
</script>
<script>
  $(function () {
    $('#example3').DataTable({
      responsive : true,
      processing : true,
      serverSide : true,
      order: [[1, 'asc']],
        ajax: {
            'url':"{{route('table.department')}}",
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
      columns: [
        {data: 'DT_RowIndex', name: 'id_prodi'},
        {data: 'nama', name:'nama'},
        {data: 'email', name:'email'},
        {data: 'alamat', name:'alamat'},
        {data: 'jurusan', name:'jurusan'},
        {data: 'action', name: 'action'}
      ],
      columnDefs: [
        {
          "targets": [0, -1],
          "searchable" : true,
          "orderable": false
        }
      ]
    });
  });
</script>
<script>
  $(function () {
    $('#example4').DataTable({
      responsive : true,
      processing : true,
      serverSide : true,
      order: [[1, 'asc']],
        ajax: {
            'url':"{{route('table.institution')}}",
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
      columns: [
        {data: 'DT_RowIndex', name: 'id_lppm'},
        {data: 'nidn', name:'nidn'},
        {data: 'nama', name:'nama'},
        {data: 'email', name:'email'},
        {data: 'alamat', name:'alamat'},
        {data: 'action', name: 'action'}
      ],
      columnDefs: [
        {
          "targets": [0, -1],
          "orderable": false,
          "searchable" : true
        }
      ]
      
    });
  });
</script>
@endpush