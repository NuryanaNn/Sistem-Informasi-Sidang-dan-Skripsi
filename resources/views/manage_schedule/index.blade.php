@extends('layout/main')
@section('title','Kelola Jadwal')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kelola Jadwal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kelola Jadwal</li>
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
                            <li class="nav-item"><a class="nav-link active" href="#cg" data-toggle="tab">Jadwal</a></li>
                            <li class="nav-item"><a class="nav-link" href="#dl" data-toggle="tab">Data Dosen</a></li>
                            <li class="nav-item"><a class="nav-link" href="#ds" data-toggle="tab">Data Mahasiswa</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="cg">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- /.card -->
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="{{ route('schedule.create')}}"
                                                    class="btn btn-primary modal-show" title="Tambah Data">Tambah</a>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <table id="example1" class="table table-bordered table-striped"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Jam</th>
                                                            <th>Ruangan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Jam</th>
                                                            <th>Ruangan</th>
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
                            <div class="tab-pane" id="dl">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- /.card -->
                                        <div class="card">
                                            <div class="card-header">
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <table id="example2" class="table table-bordered table-striped"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
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
                            <div class="tab-pane" id="ds">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- /.card -->
                                        <div class="card">
                                            <div class="card-header">
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <table id="example3" class="table table-bordered table-striped"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
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
                        </div>
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
    $(function() {
        $('#example1').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('table.mschedule')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id_jadwal'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'waktu',
                    name: 'waktu'
                },
                {
                    data: 'ruangan',
                    name: 'ruangan'
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
    $(function() {
        $('#example2').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                'url': "{{route('table.schedulelecturer')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'nidn'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'email',
                    name: 'email'
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
<script>
    $(function() {
        $('#example3').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                'url': "{{route('table.schedulestudent')}}",
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
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'jurusan',
                    name: 'jurusan'
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