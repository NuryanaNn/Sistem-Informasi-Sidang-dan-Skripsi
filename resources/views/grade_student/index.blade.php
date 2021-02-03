@extends('layout/main')
@section('title', 'Nilai Mahasiswa')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Nilai Mahasiswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Nilai Mahasiswa</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('grade')}}" class="btn btn-primary">Teknik Informatika</a>
                    <a href="{{ route('grade2')}}" class="btn btn-success">Sistem Informasi</a>
                    <a href="{{ route('grade3')}}" class="btn btn-success">Manajemen Informatika</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Nilai Proposal</th>
                                <th>Nilai Bimbingan</th>
                                <th>Nilai Sidang</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Nilai Proposal</th>
                                <th>Nilai Bimbingan</th>
                                <th>Nilai Sidang</th>
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
<script src="{{ asset('js/app.js') }}"></script>
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
                'url': "{{route('table.grade_student')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id_nilai'
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
                    data: 'nilai_pengajuan',
                    name: 'nilai_pengajuan'
                },
                {
                    data: 'nilai_bimbingan',
                    name: 'nilai_bimbingan'
                },
                {
                    data: 'nilai_sidang',
                    name: 'nilai_sidang'
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
@endpush