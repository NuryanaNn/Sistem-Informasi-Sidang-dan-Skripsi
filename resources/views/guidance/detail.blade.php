@extends('layout/main')
@section('title', 'Detail Bimbingan')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Detail Bimbingan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Detail Bimbingan</li>
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
                <div class="card card-primary">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="card direct-chat direct-chat-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Bimbingan : {{$data->nama_bab}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        <!-- Message. Default to the left -->
                                        @foreach ($data2 as $data2)
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">{{ $data2->nama_dsn }}</span>
                                                <span
                                                    class="direct-chat-timestamp float-right">{{ $data2->tanggal}}</span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img class="direct-chat-img" src="{{asset('dist/img/user2-160x160.jpg')}}"
                                                alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{ $data2->isi_revisi}} || <a
                                                    href="{{asset('upload/revisi/'.$data2->file_revisi)}}"
                                                    target="_blanlk">lihat file</a>

                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        @endforeach
                                        <!-- /.direct-chat-msg -->
                                    </div>
                                </div>
                            </div>
                            <!--/.direct-chat -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Preview PDF</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                class="fas fa-expand"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <div class="card-body">
                                    <object data="{{asset('upload/bimbingan/'.$data->file_bab)}}" width="100%"
                                        height="500px"></object>
                                    <a href="{{asset('upload/bimbingan/'.$data->file_bab)}}" target="_blank"
                                        class="btn btn-block btn-primary btn-sm"><i class="fas fa-file-download">
                                            Download File</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
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