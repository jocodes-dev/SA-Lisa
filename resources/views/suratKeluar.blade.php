@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Surat Keluar</h1>
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
                                    <th>Tanggal Surat Keluar</th>
                                    <th>Perihal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <!-- Display a loading spinner while fetching data -->
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
                        <label for="asal_surat">Tujuan Surat:</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat"
                            placeholder="Tujuan Surat">
                    </div>
                    <div class="form-group">
                        <label for="no_surat">No Surat:</label>
                        <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="No Surat">
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_surat">Jenis Surat:</label>
                        <select class="form-control" name="id_jenis_surat" id="id_jenis_surat"
                            placeholder="Jenis Surat">
                            <!-- Fill the options dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat Keluar:</label>
                        <input id="tanggal_surat" name="tanggal_surat" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal:</label>
                        <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal">
                    </div>
                    <div class="form-group">
                        <label for="file_surat_keluar">Input File Surat</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_surat_keluar"
                                    id="file_surat_keluar">
                                <label class="custom-file-label" for="file_surat_keluar">Pilih file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_user">Id User</label>
                        <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Input Here..">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary btn-send">Submit</button>
            </div>
            </form>
        </div>
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
                        <label for="asal_surat">Tujuan Surat:</label>
                        <input type="text" class="form-control" name="asal_surat" id="edit_asal_surat"
                            placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="no_surat">No Surat:</label>
                        <input type="text" class="form-control" name="no_surat" id="edit_no_surat"
                            placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_surat">Jenis Surat:</label>
                        <select name="id_jenis_surat" id="edit_id_jenis_surat" class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat Keluar:</label>
                        <input type="date" class="form-control" name="tanggal_surat" id="edit_tanggal_surat"
                            placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="file_surat_keluar">Input File Surat:</label>
                        <input type="file" class="form-control" name="file_surat_keluar" id="edit_file_surat_keluar"
                            placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal:</label>
                        <input type="text" class="form-control" name="perihal" id="edit_perihal"
                            placeholder="Input Here..">
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="id_user">Id_User</label>
                        <input type="text" class="form-control" name="id_user" id="edit_id_user"
                            placeholder="Input Here..">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="submit" form="formEdit" class="btn btn-outline-primary btn-update btn-update">Update Data</button>
            </div>

        </div>
    </div>
</div>

<script>
    const Url = 'api/v3/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar';
    const UrlJenisSurat = 'api/v1/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat'

    showTabel();


    function table(res) {
        let tableBody = '';

        if (res.code === 404) {
            // Handle the case when data is not found
            tableBody += `
        <tr>
            <td colspan="9" class="text-center">No data.</td>
        </tr>`;
        } else if (res.code === 200) {
            // Handle the case when data is available
            if (!res.data || res.data.length <= 0) {
                tableBody += `
            <tr>
                <td colspan="9" class="text-center">No data.</td>
            </tr>`;
            } else {
                for (let i = 0; i < res.data.length; i++) {
                    tableBody += `
                <tr>
                    <td>` + (i + 1) + `</td>
                    <td>` + res.data[i].asal_surat + `</td>
                    <td>` + res.data[i].no_surat + `</td>
                    <td>` + res.data[i].jenis_surat.jenis_surat + `</td>
                    <td>` + res.data[i].tanggal_surat + `</td>
                    <td>` + res.data[i].perihal + `</td>
                    <td>
                        <button id="edit-modal" data-uuid="` + res.data[i].uuid + `" class="btn btn-primary" data-toggle='modal' data-target='#EditModal'><i class="far fa-edit"></i></button>
                        <button id="delete-confirm" data-uuid="` + res.data[i].uuid + `" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>`;
                }
            }
        } else {
            // Handle other cases or errors
            console.log('Error:', res.message);
        }

        $('#tbody').html(tableBody);

    }

    // get data api
    function showTabel() {
        $("#loading-row").show();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: `{{ url('${Url}') }}`,
            success: function (res) {
                table(res);
                $("#loading-row").hide();
            },
            error: function (error) {
                console.log(error);
                $("#loading-row").hide();
            }
        })
    };

    // get jenis surat
    $(document).ready(function () {
        $.ajax({
            url: `{{ url('${UrlJenisSurat}') }}`,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // console.log(response.data, '<-- response get jenis surat');
                fillJenisSuratOptions(response.data)
                fillJenisSuratOptionsEdit(response.data)
            },
            error: function () {
                console.log("Failed to get data from server");
            }
        });

        // for create
        function fillJenisSuratOptions(data) {
            var select = $("#id_jenis_surat");
            select.empty();
            for (var i = 0; i < data.length; i++) {
                var option = $("<option>")
                    .val(data[i].id)
                    .text(data[i].jenis_surat);

                select.append(option);
            }
        }

        // for update
        function fillJenisSuratOptionsEdit(data) {
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

    // datatabel
    $(document).ready(function () {
        $("#dataTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["csv", "excel"]
        }).buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');
    });

    $(document).on('click', '#btn-add', function () {
        $('#formTambah').trigger("reset");
    });
    

    //tambah data
    $(document).ready(function () {
        var formTambah = $('#formTambah');
        formTambah.on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#loading-overlay').show();
            $.ajax({
                type: 'POST',
                url: `{{ url('${Url}/create') }}`,
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function () {
                $('.btn-send').addClass("disabled").html("Processing...").attr('disabled', true);
                },
                complete: function () {
                    $('.btn-send').removeClass("disabled").html("Submit").attr('disabled', false);
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
                            text: 'Data Success Create',
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
                    var error = data.responseJSON.errors;
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
                }
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
                $('#uuid').val(data.data.uuid);
                $('#edit_asal_surat').val(data.data.asal_surat)
                $('#edit_no_surat').val(data.data.no_surat)
                $('#edit_perihal').val(data.data.perihal)
                $('#edit_tanggal_surat').val(data.data.tanggal_surat)
                $('#edit_id_jenis_surat').val(data.data.id_jenis_surat)
                $('#edit_id_user').val(data.data.id_user)
                $('#edit_file_surat_keluar').val(data.data.file_surat_keluar)
                $('#EditModal').modal('show');
            },
            error: function () {
                alert("error");
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
                $('.btn-update').addClass("disabled").html("Processing...").attr('disabled', true);
                },
                complete: function () {
                    $('.btn-update').removeClass("disabled").html("Update Data").attr('disabled', false);
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
                                // location.reload();
                                showTabel();
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
