@extends('layouts/base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Arsip Surat Keluar / <span id="suratName"></span></h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Data arsip</h6>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tujuan Surat</th>
                        <th>Nama pembuat</th>
                        <th>No. Surat</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal Keluar</th>
                        <th>Perihal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dataTable">

                </tbody>
            </table>
        </div>

        {{-- MODAL EDIT --}}
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel"
            aria-hidden="true">
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
                                <label for="tujuan_surat">Tujuan Surat:</label>
                                <input type="text" class="form-control" name="tujuan_surat" id="edit_tujuan_surat"
                                    placeholder="Input Here..">
                            </div>
                            <div class="form-group">
                                <label for="no_surat">No Surat:</label>
                                <input type="text" class="form-control" name="no_surat" id="edit_no_surat"
                                    placeholder="Input Here..">
                            </div>
                            <div class="form-group">
                                <label for="id_jenis_surat">Jenis Surat</label>
                                <select name="id_jenis_surat" id="eid_jenis_surat" class="form-control">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_surat">Tanggal Surat Keluar:</label>
                                <input type="date" class="form-control" name="tanggal_surat" id="edit_tanggal_surat"
                                    placeholder="Input Here..">
                            </div>
                            <div class="form-group">
                                <label for="file_surat_keluar">Input File Surat</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file_surat_keluar"
                                            id="edit_file_surat_keluar">
                                        <label class="custom-file-label" id="edit_file_surat-label"
                                            for="file_surat_keluar">Pilih file</label>
                                    </div>
                                </div>
                                <span>format : Jpg,png,pdf,doc </span>
                                <img src="" id="preview-edit" class="mx-auto d-block pb-2"
                                    style="max-width: 300px; haight: 100px; padding-top: 23px;">
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal:</label>
                                <textarea type="text" class="form-control" name="perihal" id="edit_perihal" placeholder="Input Here.." rows="3"
                                    style="height: 100px;"></textarea>
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

    </div>

    <script>
        const apiUrl = "v3/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar";
        const apiJenisSurat = "v1/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat"
        // get all
        $(document).ready(function() {
            const url = window.location.href;
            const urlParts = url.split('/');

            // Ambil elemen terakhir dari array yang berisi parameter
            const parameter = urlParts[urlParts.length - 1];

            $.ajax({
                url: `{{ url('v3/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/filter/${parameter}') }}`,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var tableBody = "";
                    $.each(response.data, function(index, item) {
                        tableBody += /*html*/
                            ` <tr>
                                <td>${(index + 1)}</td>
                                <td>${item.tujuan_surat}</td>
                                <td>${item.users.name}</td>
                                <td>${item.no_surat}</td>
                                <td>${item.jenis_surat.jenis_surat}</td>
                                <td>${item.tanggal_surat}</td>
                                <td>${item.perihal}</td>
                                <td>
                                    <button class="btn btn-info download" data-filename="${item.file_surat_keluar}"><i class="fas fa-download"></i></button>
                                    <button id="edit-modal" data-uuid="${item.uuid}" class="btn btn-primary" data-toggle='modal' data-target='#EditModal'><i class="far fa-edit"></i></button>
                                    <button id="delete-confirm" data-uuid="${item.uuid}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>`
                    });

                    // data table
                    $("#dataTable").DataTable({
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                    });
                    var table = $("#dataTable").DataTable();
                    table.clear().draw();
                    table.rows.add($(tableBody)).draw();

                    let textName = response.data[0].jenis_surat.jenis_surat
                    $("#suratName").text(textName)

                    $(document).ready(function() {
                        $('.download').click(function(event) {
                            event.preventDefault();

                            var filename = $(this).data('filename');
                            var downloadUrl =
                                `{{ asset('uploads/SuratKeluar/${filename}') }}`

                            var link = document.createElement('a');
                            link.href = downloadUrl;
                            link.download = filename;
                            link.click();
                            link.remove();
                        });
                    });
                },

                error: function(error) {
                    console.log(error, "Failed to get data from server");
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
                    populateSelectOptionsEditt(response.data)
                },
                error: function() {
                    console.log("Failed to get data from server");
                }
            });

            // for update
            function populateSelectOptionsEditt(data) {
                var select = $("#eid_jenis_surat");
                select.empty();
                for (var i = 0; i < data.length; i++) {
                    var option = $("<option>")
                        .val(data[i].id)
                        .text(data[i].jenis_surat);

                    select.append(option);
                }
            }
        });


        //edit
        $(document).on('click', '#edit-modal', function() {
            let uuid = $(this).data('uuid');
            // menampilkan nama file yang baru diisi di form edit data
            $('#edit_file_surat_keluar').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $('#edit_file_surat-label').text(fileName);

                // menampilkan gambar
                if (this.files && this.files[0]) {
                    const fileEdit = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Display the image preview
                        $("#preview-edit").attr("src", e.target.result);
                    };

                    reader.readAsDataURL(fileEdit);
                }
            });
            $.ajax({
                url: `{{ url('${apiUrl}/get/${uuid}') }}`,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    console.log('get data =>', data);
                    $('#uuid').val(data.data.uuid);
                    $('#edit_tujuan_surat').val(data.data.tujuan_surat)
                    $('#edit_no_surat').val(data.data.no_surat)
                    $('#edit_perihal').val(data.data.perihal)
                    $('#edit_tanggal_surat').val(data.data.tanggal_surat)
                    $('#eid_jenis_surat').val(data.data.id_jenis_surat)
                    $('#edit_id_user').val(data.data.id_user)

                    $('#preview-edit').attr('src', "{{ asset('uploads/SuratKeluar/') }}/" + data.data
                        .file_surat_keluar);

                    // menampilkan nama file edit yang sudah tersimpan
                    var fileName = data.data.file_surat_keluar.split('\\').pop();
                    $('#edit_file_surat-label').text(fileName);

                    $('#EditModal').modal('show');
                },
                error: function() {
                    alert("Error fetching data.");
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
        $(document).on('click', '#delete-confirm', function(e) {
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
