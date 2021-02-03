@extends('layout/main')
@section('title','Profil')
@push('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profil</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Profil</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('content')
<div class="message"></div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/avatar.png') }}"
                alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $data->nama }}</h3>

            <p class="text-muted text-center">
              @if (Session::get('hak_akses') == 'mahasiswa')
              {{ $data->nim }}
              @else
              {{ $data->nidn }}
              @endif
            </p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <p class="text text-center">NO HP : {{ $data->no_hp}}</p>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="active nav-link" href="#settings" data-toggle="tab">Pengaturan Akun</a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#us" data-toggle="tab">Ubah Password</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                @if (Session::get('hak_akses') == 'mahasiswa')
                <form class="form-horizontal" id="formProfil" action="{{ route('updateProfil', $data->nim) }}"
                  method="POST">
                  @else
                  <form class="form-horizontal" id="formProfil" action="{{ route('updateProfil', $data->nidn) }}"
                    method="POST">
                    @endif

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                          value="{{$data->nama}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                          value="{{$data->email}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">No Hp</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp"
                          value="{{$data->no_hp}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                          rows="5">{{$data->alamat}}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="button" class="btn btn-primary" id="btn-update">Update</button>
                      </div>
                    </div>
                  </form>
              </div>

              <div class="tab-pane" id="us">
                @if (Session::get('hak_akses') == 'mahasiswa')
                <form class="form-horizontal" method="POST" action="{{route('updatePw', $data->nim)}}">
                  @else
                  <form class="form-horizontal" method="POST" action="{{route('updatePw', $data->nidn)}}">
                    @endif
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        @if (Session::get('hak_akses') == 'mahasiswa')
                        <input type="text" class="form-control" id="username" name="username" value="{{ $data->nim }}"
                          readonly>
                        @else
                        <input type="text" class="form-control" id="username" name="username" value="{{ $data->nidn }}"
                          readonly>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Password Lama</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="current_pass" name="current_pass"
                          placeholder="Pasword Lama " value="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Pasword Baru</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password"
                          placeholder="Pasword Baru" value="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Ulangi password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password_confirmation"
                          id="password_confirmation" placeholder="Ulangi Pasword" value="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="button" id="btn-save" class="btn btn-primary">Ubah Password</button>
                      </div>
                    </div>
                  </form>
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
@push('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function() {
    $('body').on('click', '#btn-save', function(e) {
      e.preventDefault();

      var form = $('#us form'),
        current_pass = $('#current_pass').val(),
        password = $('#password').val(),
        password_confirmation = $('#password_confirmation').val();
      form.find('.invalid-feedback').remove();
      form.find('.form-control').removeClass('is-invalid');

      $.ajax({
        url: form.attr('action'),
        method: 'POST',
        cache: false,
        data: {
          'current_pass': current_pass,
          'password': password,
          'password_confirmation': password_confirmation
        },
        success: function(response) {
          if (response.success == true) {
            $(".message").html('<div class="row" id="div-alert">' +
              '<div class="col-lg-12">' +
              '<div class="mb-4">' +
              '<div id="alert" class="alert alert-success">' + response.message + '</div>' +
              '</div>' +
              '</div>' +
              '</div>');
          } else {
            $("#current_pass").addClass('is-invalid');
            $("#for_current").append('<div class="invalid-feedback">' + response.message + '</div>');
          }
          console.log(response);
        },
        error: function(response) {
          var res = response.responseJSON;
          if ($.isEmptyObject(res) == false) {
            $.each(res.errors, function(key, value) {
              $('#' + key)
                .closest('.form-control')
                .addClass('is-invalid')
                .closest('.form-group')
                .append('<div class="invalid-feedback">' + value + '</div>')
            });
          }
          console.log(response);
        }
      });
    });
    window.setTimeout(function() {
      $("#div-alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 4000);
  });
</script>
<script>
  $(document).ready(function() {
    $('#btn-update').on('click', function(event) {
      event.preventDefault();
      var form = $('#settings form'),
        url = form.attr('action'),
        method = 'PUT';

      $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function(response) {
          Swal.fire({
            title: 'Success !',
            icon: 'success',
            text: 'Data Profile Berhasil Diubah !'
          });
        },
        error: function(xhr) {
          var res = xhr.responseJSON;
          if ($.isEmptyObject(res) == false) {
            $.each(res.errors, function(key, value) {
              $('#' + key)
                .closest('.form-control')
                .addClass('is-invalid')
                .closest('.form-group')
                .append('<div class="invalid-feedback">' + value + '</div>')
            });
          }
        }
      });
    });
  });
</script>

@endpush