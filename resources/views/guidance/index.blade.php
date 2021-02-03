@extends('layout/main')
@section('title', 'Bimbingan')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Bimbingan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Bimbingan</li>
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
    <div class="row">
        <div class="col-12">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-primary">
                <div class="card-header">
                    <h2 class="card-title">Identitas Dosen Pembimbing</h2>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        @foreach ($dosen as $d)
                        <div class="col-md-6">
                            <!-- Input addon -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{asset('dist/img/avatar.png')}}" alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center">{{ $d->nama }}</h3>
                                    <h4 class="profile-username text-center">NIDN. {{ $d->nidn }}</h4>
                                    <p class="text-muted text-center">{{$d->no_hp}}</p>
                                    <p class="text-muted text-center">{{$d->email}}</p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.card -->
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/avatar.png')}}"
                            alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{$data->nama}}</h3>
                    <p class="text-muted text-center">
                    </p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <p class="text text-center">HP : {{$data->no_hp}} </p>
                            <p class="text text-center">Nilai Bimbingan :
                                {{ $data2 != NULL ? $data2->nilai_bimbingan : '-' }}</p>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-9">
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
                                        <div class="card-header">
                                            <a href="{{ route('guidance.create')}}"
                                                class="btn btn-primary modalnofooter-show"
                                                title="Tambah Data">Tambah</a>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <table id="example1" class="table table-bordered table-striped"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Bab</th>
                                                        <th>File Bab</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal</th>
                                                        <th>Status 1</th>
                                                        <th>Status 2</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Bab</th>
                                                        <th>File Bab</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal</th>
                                                        <th>Status 1</th>
                                                        <th>Status 2</th>
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
                                                        <th>Nama Bab</th>
                                                        <th>File Bab</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal</th>
                                                        <th>Status 1</th>
                                                        <th>Status 2</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Bab</th>
                                                        <th>File Bab</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal</th>
                                                        <th>Status 1</th>
                                                        <th>Status 2</th>
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
    <!-- /.col -->
    </div>
    <!-- /.row -->
    @include('layout/_modal_without_footer')
</section>
@endsection
@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.modalnofooter-show', function (e) {
            e.preventDefault();
            var me = $(this),
                url = me.attr('href'),
                form = $('.modal-body form'),
                title = me.attr('title');
            $.ajax({
                url: url,
                dataType: 'html',
                success: function (response) {
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
                'url': "{{route('table.guidance')}}",
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
                    data: 'nama_bab',
                    name: 'nama_bab'
                },
                {
                    data: 'bab',
                    name: 'bab'
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
                    data: 'status_1',
                    name: 'status_1'
                },
                {
                    data: 'status_2',
                    name: 'status_2'
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
                'url': "{{route('table.guidance2')}}",
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
                    data: 'nama_bab',
                    name: 'nama_bab'
                },
                {
                    data: 'bab',
                    name: 'bab'
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
                    data: 'status_1',
                    name: 'status_1'
                },
                {
                    data: 'status_2',
                    name: 'status_2'
                },
                {
                     data: 'action',
                     name: 'action'
                }
            ]
        });
    });

</script>
@endpush