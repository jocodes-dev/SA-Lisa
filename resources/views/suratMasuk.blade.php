@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Surat Masuk</h1>
    </div>
</div>
@endsection
@section('main-content')
<div id="loading-overlay" class="loading-overlay" style="display: none;">
    <div id="loading" class="loading">
        <img src="{{ asset('loading.gif') }}" alt="Loading..." />
    </div>
</div>
<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold ">Data surat masuk</h6>
        <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#DivisiModal"
            id="#myBtn">
            Tambah Data
        </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Asal Surat</th>
                    <th>No Surat</th>
                    <th>Perihal</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Surat Masuk</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    {{-- modal create --}}
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
                            <label for="asal_surat">asal surat</label>
                            <input type="text" class="form-control" name="asal_surat" id="asal_surat" placeholder="Input Here..">
                        </div>
                        <div class="form-group">
                            <label for="no_surat">no surat</label>
                            <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Input Here..">
                        </div>
                        <div class="form-group">
                            <label for="perihal">perihal</label>
                            <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Input Here..">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_surat">tanggal surat</label>
                            <input type="date" class="form-control" name="tanggal_surat" id="tanggal_surat" placeholder="Input Here..">
                        </div>
                        <div class="form-group">
                            <label for="id_jenis_surat">jenis surat</label>
                            <select name="id_jenis_surat" id="id_jenis_surat" class="form-control">
                                <option value="" disabled selected>-- select --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file_surat_masuk">file surat masuk</label>
                            <input type="file" class="form-control" name="file_surat_masuk" id="file_surat_masuk" placeholder="Input Here..">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edit Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid" id="uuid">
                    <div class="form-group">
                        <label for="asal_surat">asal surat</label>
                        <input type="text" class="form-control" name="asal_surat" id="edit_asal_surat" placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="no_surat">no surat</label>
                        <input type="text" class="form-control" name="no_surat" id="edit_no_surat" placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="perihal">perihal</label>
                        <input type="text" class="form-control" name="perihal" id="edit_perihal" placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">tanggal surat</label>
                        <input type="date" class="form-control" name="tanggal_surat" id="edit_tanggal_surat" placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_surat">jenis surat</label>
                        <select name="id_jenis_surat" id="edit_id_jenis_surat" class="form-control">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">file surat masuk</label>
                        <input type="file" class="form-control" name="file_surat_masuk" id="edit_file_surat_masuk" placeholder="Input Here..">
                        <label for="edit_file_surat_masuk" id="edit_file_surat_masuk-label"></label>
                    </div>
                    
                    <div class="form-group">
                        <label for="file_surat_masuk">preview</label>
                        <img src="" alt="" id="preview" class="w-100">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="submit" form="formEdit" class="btn btn-outline-primary">Update Data</button>
            </div>

        </div>
    </div>
</div>
<script>
const apiUrl = "v2/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk";
const apiJenisSurat = "v1/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat"

$(document).ready(function() {
    // handle cetak data
    // var dataTable = $("#dataTable").DataTable({
    //     "responsive": true,
    //     "lengthChange": false,
    //     "autoWidth": false,
    //     "buttons": ["csv", "excel"]
    // }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
    $.ajax({
        url: `{{ url('${apiUrl}') }}`,
        method: "GET",
        dataType: "json",
        success: function(response) {
            let tableBody = "";
            $.each(response.data, function(index, item) {
                tableBody += /*html*/
                    `<tr>
                        <td>${(index + 1)}</td> 
                        <td>${item.asal_surat}</td>
                        <td>${item.no_surat}</td>
                        <td>${item.perihal}</td>
                        <td>${item.jenis_surat.jenis_surat}</td>
                        <td>${item.tanggal_surat}</td>
                    
                        <td>
                            <button class='btn btn-success download-link' data-filename="${item.file_surat_masuk}">
                                <i class="fa-solid fa-download"></i>
                            </button>
                            <button type='button' class='btn btn-primary edit-modal' data-toggle='modal' data-target='#EditModal' data-uuid='${item.uuid}'> 
                                <i class='fa fa-edit'></i>
                            </button> 
                            <button type='button' class='btn btn-danger delete-confirm' data-uuid='${item.uuid} '>
                                <i class='fa fa-trash'></i>
                            </button> 
                        </td>
                    </tr>`
            });
            var table = $("#dataTable").DataTable();
            table.clear().draw();
            table.rows.add($(tableBody)).draw();

            $(document).ready(function() {
                $('.download-link').click(function(event) {
                    event.preventDefault();

                    var filename = $(this).data('filename');
                    var downloadUrl = `{{ asset('uploads/suratMasuk/${filename}')}}`

                    var link = document.createElement('a');
                    link.href = downloadUrl;
                    link.download = filename;
                    link.click();
                    link.remove();
                });
            });

        },
        error: function() {
            console.log("Failed to get data from server");
        }
    });
});

// get jenis surat
$(document).ready(function() {
    $.ajax({
        url: `{{ url('${apiJenisSurat}') }}`,
        method: "GET",
        dataType: "json",
        success: function(response) {
            populateSelectOptions(response.data)
            populateSelectOptionsEditt(response.data)
        },
        error: function() {
            console.log("Failed to get data from server");
        }
    });

    // for create
    function populateSelectOptions(data) {
        var select = $("#id_jenis_surat");
        for (var i = 0; i < data.length; i++) {
            var option = $("<option>")
            .val(data[i].id)
            .text(data[i].jenis_surat);

            select.append(option);
        }
    }

    // for update
    function populateSelectOptionsEditt(data) {
        var select = $("#edit_id_jenis_surat");
        select.empty();
        for (var i = 0; i < data.length; i++) {
            var option = $("<option>")
            .val(data[i].id)
            .text(data[i].jenis_surat);

            select.append(option);
        }
    }
});


//tambah data
$(document).ready(function() {
    var formTambah = $('#formTambah');
    formTambah.on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#loading-overlay').show();
        $.ajax({
            type: 'POST',
            url: `{{ url('${apiUrl}/create') }}`,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#loading-overlay').hide();
                if (data.message === 'check your validation') {
                    var error = data.errors;
                    var errorMessage = "";

                    $.each(error, function(key, value) {
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
                        text: 'Data Success Create',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function(data) {
                $('#loading-overlay').hide();

                var error = data.responseJSON.errors;
                var errorMessage = "";

                $.each(error, function(key, value) {
                    errorMessage += value[0] + "<br>";
                });

                Swal.fire({
                    title: 'Error',
                    html: errorMessage,
                    icon: 'error',
                    timer: 5000,
                    showConfirmButton: true
                });
            }
        });
    });
});

//edit
$(document).on('click', '.edit-modal', function() {
    let uuid = $(this).data('uuid');
    $.ajax({
        url: `{{ url('${apiUrl}/get/${uuid}') }}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            $('#uuid').val(response.data.uuid);
            $('#edit_asal_surat').val(response.data.asal_surat)
            $('#edit_no_surat').val(response.data.no_surat)
            $('#edit_perihal').val(response.data.perihal)
            $('#edit_tanggal_surat').val(response.data.tanggal_surat)
            $('#edit_id_jenis_surat').val(response.data.id_jenis_surat)
            
            $('#edit_file_surat_masuk').html(response.data.file_surat_masuk)
            var filename = response.data.file_surat_masuk.split('/')
            $('#edit_file_surat_masuk-label').text(filename)

            $('#preview').attr('src', `{{ asset('uploads/suratMasuk/${response.data.file_surat_masuk}')}}`)
            $('#edit_id_user').val(response.data.id_user)

            $('#EditModal').modal('show');
        },
        error: function() {
            alert("error");
        }
    });
});

//update
$(document).ready(function() {
    var formEdit = $('#formEdit');
    formEdit.on('submit', function(e) {
        e.preventDefault();
        var uuid = $('#uuid').val();
        var formData = new FormData(this);
        $('#loading-overlay').show();
        $.ajax({
            type: "POST",
            url: `{{ url('${apiUrl}/update/') }}/${uuid}`,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                $('#loading-overlay').hide();
                if (data.message === 'check your validation') {
                    var error = data.errors;
                    var errorMessage = "";
                    $.each(error, function(key, value) {
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
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function(data) {
                $('#loading-overlay').hide();
                var errors = data.responseJSON.errors;
                var errorMessage = "";

                $.each(errors, function(key, value) {
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
$(document).on('click', '.delete-confirm', function(e) {
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
                url: `{{ url('${apiUrl}/delete/${uuid}') }}`,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "uuid": uuid
                },
                success: function(response) {
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
                error: function() {
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
