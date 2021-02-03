@extends('layout/main')
@section('title','Kelola Bimbingan')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kelola Bimbingan Skripsi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kelola Bimbingan Skripsi</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<section class="content">
    @if (Session::has('success'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @elseif(Session::has('error'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        </div>
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#data" data-toggle="tab">Bimbingan</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#riwayat" data-toggle="tab">Riwayat</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="data">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- /.card -->
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <table id="example1" class="table table-bordered table-striped"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nim</th>
                                                            <th>Nama</th>
                                                            <th>Nama Bab</th>
                                                            <th>File BAB</th>
                                                            <th>Keterangan</th>
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nim</th>
                                                            <th>Nama</th>
                                                            <th>Nama Bab</th>
                                                            <th>File BAB</th>
                                                            <th>Keterangan</th>
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="riwayat">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- /.card -->
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <table id="example2" class="table table-bordered table-striped"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nim</th>
                                                            <th>Nama</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nim</th>
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
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    @include('layout/_modal')
    @include('layout/_modal_without_footer')
</section>
@endsection
@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script>
    $(function(){
      $('body').on('click', '.modalnofooter-show', function(e){
        e.preventDefault();
        var me = $(this),
            url = me.attr('href'),
            form = $('.modal-body form'),
            title = me.attr('title');

        $.ajax({
          url : url,
          dataType : 'html',
          success : function(response){
              console.log(title);
              $('#modal-title-nofooter').html(title);
              $('#modal-body-nofooter').html(response);
          }
        });
  
        $('#modal-nofooter').modal('show');
      });
    });
</script>
<script>
    $(function () {
        $('#example1').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                'url': "{{route('table.manage_guidance')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id_bimbingan'
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nama_bab',
                    name: 'nama_bab'
                },
                {
                    data: 'file_bab',
                    name: 'file_bab'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });

</script>
<script>
    $(function () {
        $('#example2').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                'url': "{{route('table.riwayatbb')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'nim'
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            columnDefs: [{
                "targets": [0, -1],
                "orderable": false,
                "searchable": true
            }]

        });
    });

</script>
@endpush