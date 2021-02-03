@extends('layout/main')
@section('title', 'Detail Kelompok Mahasiswa')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Daftar Anggota {{ $data->nama_grup}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('manage_group') }}">Data Kelompok</a></li>
            <li class="breadcrumb-item active">{{ $data->nama_grup }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('content')
<section class="content">
    <div class="row">
      <div class="col-6">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
             Mahasiswa
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
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
      <div class="col-6">
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            Dosen
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example3" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Nama</th>
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
    <!-- /.row -->
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
        ajax: {
            'url':"{{route('table.dgstudent', $data->id_grup)}}",
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
      columns: [
        {data: 'DT_RowIndex', name:'nim'},
        {data: 'nama', name:'nama'},
        {data: 'jurusan', name:'jurusan'},
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
    $('#example3').DataTable({
      responsive : true,
      processing : true,
      serverSide : true,
        ajax: {
            'url':"{{route('table.dglecturer', $data->id_grup)}}",
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
      columns: [
        {data: 'DT_RowIndex', name:'nidn'},
        {data: 'nama', name:'nama'},
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