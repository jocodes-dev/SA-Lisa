<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset('assets/dist/img/lambang_kota_palu.png')}}" alt="" style="width: 75px">
      <br>
      <span class="h3"><b>Kel. Besusu Timur</b></span>
    </div>
    <div class="card-body">
      @include('sweetalert::alert')

      <form id="loginForm" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

<script src="{{ asset('assets/sweetalert/script.js')}}"></script>

<script>
const apiUrl = '56cfb271-4e29-47cc-a237-8ae819491903/user/login'

$(document).ready(function() {
  var formTambah = $('#loginForm');
  formTambah.on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $('#loading-overlay').show();
    $.ajax({
      type: 'POST',
      url: `{{ url('${apiUrl}') }}`,
      data: formData,
      dataType: 'JSON',
      contentType: false,
      processData: false,
      success: function(data) {
        localStorage.setItem('token', data.access_token);
        Swal.fire({
          title: 'Success',
          text: 'Berhasil Login',
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'OK'
        }).then(function() {
          window.location.href = '/';
        });
      },
      error: function(data) {
        Swal.fire({
          title: 'Error',
          html: 'Email atau password salah',
          icon: 'error',
          timer: 5000,
          showConfirmButton: true
        });
        }
      });
  });
});

const apiCheck = "v2/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk";

$(document).ready(function() {
  $.ajax({
    url: `{{ url('${apiCheck}') }}`,
    method: "GET",
    dataType: "json",
    success: function(response) {
      window.location.href = '/';
    },
    error: function() {

    }
  });
});
</script>