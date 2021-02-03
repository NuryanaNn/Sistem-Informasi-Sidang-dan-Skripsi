@extends('layout/main')
@section('title','View Pasca')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Pasca</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">View Pasca</li>
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
                            <li class="nav-item"><a class="nav-link active" href="#ti" data-toggle="tab">Teknik
                                    Informatika</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#si" data-toggle="tab">Sistem Informasi</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#mi" data-toggle="tab">Manajemen
                                    Informatika</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="ti">
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
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>File Skripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>File Skripsi</th>
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
                            <div class="tab-pane" id="si">
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
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>File Skripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>File Skripsi</th>
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
                            <div class="tab-pane" id="mi">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- /.card -->
                                        <div class="card">
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive">
                                                <table id="example3" class="table table-bordered table-striped"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>File Skripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>File Skripsi</th>
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
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                'url': "{{route('table.pascati')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id_pcs'
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
                    data: 'skripsi',
                    name: 'skripsi'
                },
            ],
            columnDefs: [{
                "targets": [0, -1],
                "orderable": false,
                "searchable": false
            }]

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
                'url': "{{route('table.pascasi')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id_pcs'
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
                    data: 'skripsi',
                    name: 'skripsi'
                }
            ],
            columnDefs: [{
                "targets": [0, -1],
                "orderable": false,
                "searchable": false
            }]

        });
    });

</script>
<script>
    $(function () {
        $('#example3').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            order: [
                [1, 'asc']
            ],
            ajax: {
                'url': "{{route('table.pascami')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id_pcs'
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
                    data: 'skripsi',
                    name: 'skripsi'
                }
            ],
            columnDefs: [{
                "targets": [0, -1],
                "orderable": false,
                "searchable": false
            }]

        });
    });

</script>
@endpush