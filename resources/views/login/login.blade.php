<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset ('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="{{asset('dist/img/logo.png')}}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Selamat Datang</b></a>
    </div>
    <!-- /.login-logo -->
    <div class=" card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
        <div class="alert alert-danger" style="margin-bottom: 10px; display:none;" id="msg-container">
          <span class="text text-white" id="msg"></span>
        </div>
        <div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="username" name="username" id="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <div class="invalid-feedback" id="forusername"></div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <div class="invalid-feedback" id="forpassword"></div>
          </div>
          <div class="input-group mb-3">
            <select name="role" id="hak_akses" class="form-control">
              <option value="mahasiswa">mahasiswa</option>
              <option value="dosen">dosen</option>
              <option value="lppm">lppm</option>
              <option value="prodi">prodi</option>
            </select>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="lihat">
                <label for="lihat">
                  Lihat Password
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btn-login" class="btn btn-primary btn-block">Masuk</button>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
    </div>
    <div class=" card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Lupa Password?</p>
        <div class="alert alert-danger" style="margin-bottom: 10px; display:none;" id="msg-container">
          <span class="text text-white" id="msg"></span>
        </div>
        <div>
          <p>Silahkan kirim username anda melalui E-Mail:info@stmik-sumedang.ac.id dengan subjek Lupa Password</p>
        </div>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }} "></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#lihat').click(function() {
        if ($(this).is(':checked')) {
          $('#password').attr('type', 'text');
        } else {
          $('#password').attr('type', 'password');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#btn-login").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        var hak_akses = $("#hak_akses").val();
        var token = $("meta[name='csrf-token']").attr("content");

        if (username.length == "" && password.length == "") {
          $("#username").addClass("is-invalid");
          $("#forusername").html('Nama pengguna tidak boleh kosong');
          $("#password").addClass("is-invalid");
          $("#forpassword").html('Kata sandi tidak boleh kosong');
          $("#msg").html('');
        } else if (username.length != "" && password.length == "") {
          $("#username").removeClass("is-invalid");
          $("#forusername").html('');
          $("#password").addClass("is-invalid");
          $("#forpassword").html('Kata sandi tidak boleh kosong');
          $("#msg").html('');
        } else if (username.length == "" && password.length != "") {
          $("#password").removeClass("is-invalid");
          $("#forpassword").html('');
          $("#username").addClass("is-invalid");
          $("#forusername").html('Nama pengguna tidak boleh kosong');
          $("#msg").html('');
        } else {
          $.ajax({
            url: "{{ route('login.auth') }}",
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
              "username": username,
              "password": password,
              "hak_akses": hak_akses,
              "_token": token
            },
            success: function(response) {
              if (response.success) {
                window.location.href = "{{ url('dashboard') }}"
              } else {
                console.log(response.success);
              }
              console.log(response);
            },
            error: function(status, response) {
              $("#username").removeClass("is-invalid");
              $("#password-").removeClass("is-invalid");
              $("#forusername").html('');
              $("#forpassword").html('');
              var status = JSON.parse(status.responseText);
              $("#msg-container").css('display', 'block');
              $("#msg").html(status.message);
              console.log(status);
            }
          });
        }
      });
    });
  </script>

</body>

</html>