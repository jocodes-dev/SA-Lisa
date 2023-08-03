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
          <h3 class="card-title">Table Tambah Data</h3>
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
                                  <th>Name</th>
                                  <th>Email</th>
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

{{-- MODAL EDIT --}}
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="EditModalLabel">Edit Surat Keluar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="formEdit" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="uuid" id="uuid">
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="edit_email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                      <label for="name">Username</label>
                      <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter username">
                    </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="edit_password_confirmation" placeholder="Confirm Password">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
              <button type="submit" form="formEdit" class="btn btn-outline-primary btn-update btn-update">Update
                  Data</button>
          </div>

      </div>
  </div>
</div>


<script>
  const Url = 'v4/56cfb271-4e29-47cc-a237-8ae819491903/user';

  // render data api
  $(document).ready(function () {
  $("#loading-row").show();

  $.ajax({
      type: 'GET',
      dataType: "json",
      url: `{{ url('${Url}') }}`,
      success: function (res) {
          $("#loading-row").hide();

          if (res.code === 404) {
              // Handle the case when data is not found
              $("#tbody").html(`
                  <tr>
                      <td colspan="7" class="text-center">No data.</td>
                  </tr>
              `);
          } else if (res.code === 200) {
              // Handle the case when data is available
              if (!res.data || res.data.length === 0) {
                  $("#tbody").html(`
                      <tr>
                          <td colspan="7" class="text-center">No data.</td>
                      </tr>
                  `);
              } else {
                  // Clear existing content before appending new rows
                  $("#tbody").empty();

                  // Append each row to the table
                  res.data.forEach((data, index) => {
                      const newRow = `
                          <tr>
                              <td>${index + 1}</td>
                              <td>${data.name}</td>
                              <td>${data.email}</td>
                              <td>
                                  <button id="edit-modal" data-uuid="${data.uuid}" class="btn btn-primary" data-toggle='modal' data-target='#EditModal'><i class="far fa-edit"></i></button>
                                  <button id="delete-confirm" data-uuid="${data.uuid}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                              </td>
                          </tr>
                      `;
                      $("#tbody").append(newRow);
                  });
              }
          } else {
              // Handle other cases or errors
              console.log('Error:', res.message);
          }

          // data table
          $("#dataTable").DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": false,
              "buttons": ["csv", "excel"]
          }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
      },
      error: function (error) {
          console.log(error);
          $("#loading-row").hide();
      }
  });

  });

  // tambah data
  $(document).ready(function () {
    const formTambah = $('#formTambah'); // Add this line to get the form by ID

    formTambah.on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      $('#loading-overlay').show();

      $.ajax({
        type: 'POST',
        url: `{{ url('${Url}/create') }}`,
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

  //edit
  $(document).on('click', '#edit-modal', function () {
      let uuid = $(this).data('uuid');
      $.ajax({
          url: `{{ url('${Url}/get/${uuid}') }}`,
          type: 'GET',
          dataType: 'JSON',
          success: function (data) {
              console.log('get data =>', data);
              $('#uuid').val(data.data.uuid);
              $('#edit_name').val(data.data.name);
              $('#edit_email').val(data.data.email);
              $('#edit_password').val(data.data.password);
              $('#edit_edit_password_confirmation').val(data.data.edit_password_confirmation);
              $('#EditModal').modal('show');
          },
          error: function () {
              alert("Error fetching data.");
          }
      });
  });

  // update
  $(document).ready(function () {
      var formEdit = $('#formEdit');
      formEdit.on('submit', function (e) {
          e.preventDefault();
          var uuid = $('#uuid').val();
          var formData = new FormData(this);
          $('#loading-overlay').show();
          $.ajax({
              type: "POST",
              url: `{{ url('${Url}/update/') }}/${uuid}`,
              data: formData,
              dataType: 'json',
              contentType: false,
              processData: false,
              beforeSend: function () {
                  $('.btn-update').addClass("disabled").html("Processing...").attr(
                      'disabled', true);
              },
              complete: function () {
                  $('.btn-update').removeClass("disabled").html("Update Data").attr(
                      'disabled', false);
              },
              success: function (data) {
                  $('#loading-overlay').hide();
                  if (data.message === 'check your validation') {
                      var error = data.errors;
                      var errorMessage = "";
                      $.each(error, function (key, value) {
                          errorMessage += value[0] + "<br>";
                      });
                      Swal.fire({
                          title: 'Error',
                          html: errorMessage,
                          icon: 'error',
                          timer: 5000,
                          showConfirmButton: true
                      });
                  } else {
                      $('#loading-overlay').hide();
                      Swal.fire({
                          title: 'Success',
                          text: 'Data Success Update',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'OK'
                      }).then(function () {
                          location.reload();
                      });
                  }
              },
              error: function (data) {
                  $('#loading-overlay').hide();
                  var errors = data.responseJSON.errors;
                  var errorMessage = "";

                  $.each(errors, function (key, value) {
                      errorMessage += value + "<br>";
                  });

                  Swal.fire({
                      title: "Error",
                      html: errorMessage,
                      icon: "error",
                      timer: 5000,
                      showConfirmButton: true
                  });
              }
          });
      });
  });

  //delete
  $(document).on('click', '#delete-confirm', function (e) {
      e.preventDefault();
      var uuid = $(this).data('uuid');
      Swal.fire({
          title: 'Anda yakin ingin menghapus data ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Delete',
          cancelButtonText: 'Cancel',
          resolveButton: true
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: `{{ url('${Url}/delete/${uuid}') }}`,
                  type: 'DELETE',
                  data: {
                      "_token": "{{ csrf_token() }}",
                      "uuid": uuid
                  },
                  success: function (response) {
                      if (response.code === 200) {
                          Swal.fire({
                              title: 'Data berhasil dihapus',
                              icon: 'success',
                              timer: 5000,
                              showConfirmButton: true
                          }).then((result) => {
                              location.reload();
                          });
                      } else {
                          Swal.fire({
                              title: 'Gagal menghapus data',
                              text: response.message,
                              icon: 'error',
                              timer: 5000,
                              showConfirmButton: true
                          });
                      }
                  },
                  error: function () {
                      Swal.fire({
                          title: 'Terjadi kesalahan',
                          text: 'Gagal menghapus data',
                          icon: 'error',
                          timer: 5000,
                          showConfirmButton: true
                      });
                  }
              });
          }
      });
  });

</script>

@endsection