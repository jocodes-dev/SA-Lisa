@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Tambah User</h1>
    </div>
</div>
@endsection
@section('main-content')
<div class="col-12">
  <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h3 class="card-title">Table Surat Keluar</h3>
          <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#DivisiModal"
              id="btn-add">
              Tambah Data
          </button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <div id="dataTables_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                  <div class="col-sm-12">
                      <table id="dataTable" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Tujuan Surat</th>
                                  <th>No. Surat</th>
                                  <th>Jenis Surat</th>
                                  <th>Tanggal Keluar</th>
                                  <th>Perihal</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id="tbody">
                              
                              <tr id="loading-row" style="display: none;">
                                  <td colspan="9" class="text-center">
                                      <i class="fa fa-spinner fa-spin"></i> Loading...
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<div class="modal fade" id="DivisiModal" tabindex="-1" role="dialog" aria-labelledby="DivisiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DivisiModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="formTambah" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                          <label for="name">Username</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter username">
                        </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                      </div>
                      
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary btn-send">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<div class="card card-primary mx-5">
    <div class="card-header">
      <h3 class="card-title">Tambah User</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="formTambah" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="uuid">
      <div class="card-body">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter username">
          </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-send">Submit</button>
      </div>
    </form>
</div>


<script>
  const Url = 'v4/56cfb271-4e29-47cc-a237-8ae819491903/user/create';

  $(document).ready(function () {
    const formTambah = $('#formTambah'); // Add this line to get the form by ID

    formTambah.on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      $('#loading-overlay').show();

      $.ajax({
        type: 'POST',
        url: Url, // Remove unnecessary template literal
        data: formData,
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        contentType: false,
        processData: false,
        beforeSend: function () {
          $('.btn-send').addClass('disabled').html('Processing...').attr('disabled', true);
        },
        complete: function () {
          $('.btn-send').removeClass('disabled').html('Submit').attr('disabled', false);
        },
        success: function (data) {
          if (data.message === 'check your validation') {
            var error = data.errors;
            var errorMessage = '';

            $.each(error, function (key, value) {
              errorMessage += value[0] + '<br>';
            });

            Swal.fire({
              title: 'Error',
              html: errorMessage,
              icon: 'error',
              timer: 5000,
              showConfirmButton: true,
            });
          } else {
            Swal.fire({
              title: 'Success',
              text: 'Data Success Create',
              icon: 'success',
              showCancelButton: false,
              confirmButtonText: 'OK',
            }).then(function () {
              location.reload();
            });
          }
        },
        error: function (data) {
          var error = data.responseJSON.errors;
          var errorMessage = '';

          $.each(error, function (key, value) {
            errorMessage += value[0] + '<br>';
          });

          Swal.fire({
            title: 'Error',
            html: errorMessage,
            icon: 'error',
            timer: 5000,
            showConfirmButton: true,
          });
        },
      });
    });
  });
</script>

@endsection