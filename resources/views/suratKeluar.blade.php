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
            {{-- <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal" data-target="#DivisiModal"
                id="#myBtn">
                Tambah Data
            </button> --}}
            <button type="button" id="add-data" class="btn btn-outline-primary ml-auto" data-toggle="modal"
                data-target="#modal-default">
                Tambah Data
            </button>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="surat-keluar_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="surat-keluar" class="table table-bordered table-striped dataTable dtr-inline"
                            role="grid" aria-describedby="surat-keluar_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="surat-keluar"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="Nama User: activate to sort column ascending">Nama User
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="No. Surat: activate to sort column ascending">No. Surat
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="No. Surat: activate to sort column ascending">Jenis
                                        Surat
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="Tanggal Masuk Surat: activate to sort column ascending">
                                        Tanggal Keluar
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="Perihal: activate to sort column ascending">Perihal</th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="File Surat Masuk: activate to sort column ascending">
                                        File Surat</th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="Asal Surat: activate to sort column ascending">Tujuan
                                        Surat</th>
                                    <th class="sorting" tabindex="0" aria-controls="surat-keluar" rowspan="1"
                                        colspan="1" aria-label="Action: activate to sort column ascending">Action
                                    </th>
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
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">No</th>
                                    <th rowspan="1" colspan="1">Nama User</th>
                                    <th rowspan="1" colspan="1">No. Surat</th>
                                    <th rowspan="1" colspan="1">Jenis Surat</th>
                                    <th rowspan="1" colspan="1">Tanggal Keluar</th>
                                    <th rowspan="1" colspan="1">Perihal</th>
                                    <th rowspan="1" colspan="1">File Surat</th>
                                    <th rowspan="1" colspan="1">Tujuan Surat</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formData" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="uuid">
                    {{-- <div class="form-group">
                        <label for="id_user">Nama</label>
                        <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Input Here..">
                    </div> --}}
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
                        <label for="tanggal_surat">Date:</label>
                        <input id="tanggal_surat" name="tanggal_surat" type="date" class="form-control" value="{{ date('Y-m-d') }}" >
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
                        <label for="asal_surat">Tujuan Surat</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat"
                            placeholder="Tujuan Surat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-send" class="btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


{{-- modal create --}}
{{-- <div class="modal fade" id="DivisiModal" tabindex="-1" role="dialog" aria-labelledby="DivisiModalLabel"
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
                        <label for="id_user">Nama</label>
                        <input type="text" class="form-control" name="id_user" id="id_user"
                            placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="no_surat">No Surat:</label>
                        <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="No Surat">
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_surat">Jenis Surat:</label>
                        <select class="form-control" name="id_jenis_surat" id="id_jenis_surat" placeholder="Jenis Surat">
                            <!-- Fill the options dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Date:</label>
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
                        <label for="asal_surat">Tujuan Surat</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat"
                            placeholder="Tujuan Surat">
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
</div> --}}


{{-- MODAL EDIT --}}
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edit jenis surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="uuid" id="uuid">
                    <input type="hidden" name="uuid">
                    <div class="form-group">
                        <label for="id_user">Nama</label>
                        <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Input Here..">
                    </div>
                    <div class="form-group">
                        <label for="no_surat">No Surat:</label>
                        <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="No Surat">
                    </div>
                    <div class="form-group">
                        <label for="id_jenis_surat">Jenis Surat:</label>
                        <input type="text" class="form-control" name="id_jenis_surat" id="id_jenis_surat"
                            placeholder="Jenis Surat">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Date:</label>
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
                        <label for="asal_surat">Tujuan Surat</label>
                        <input type="text" class="form-control" id="asal_surat" name="asal_surat"
                            placeholder="Tujuan Surat">
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

    
    const url = 'http://127.0.0.1:8000/api/v3';

    showTabel();

    function table(res) {
        let htmlView = '';

        if (res.code === 404) {
            // Handle the case when data is not found
            htmlView += `
        <tr>
            <td colspan="9" class="text-center">No data 1.</td>
        </tr>`;
        } else if (res.code === 200) {
            // Handle the case when data is available
            if (!res.data || res.data.length <= 0) {
                htmlView += `
            <tr>
                <td colspan="9" class="text-center">No data.</td>
            </tr>`;
            } else {
                for (let i = 0; i < res.data.length; i++) {
                    htmlView += `
                <tr>
                    <td>` + (i + 1) + `</td>
                    <td>` + res.data[i].id_user + `</td>
                    <td>` + res.data[i].nomor_surat + `</td>
                    <td>` + res.data[i].id_jenis_surat + `</td>
                    <td>` + res.data[i].tanggal_surat + `</td>
                    <td>` + res.data[i].perihal + `</td>
                    <td>` + res.data[i].file_surat_masuk + `</td>
                    <td>` + res.data[i].asal_surat + `</td>
                    <td>
                        <button id="editData" data-uuid="` + res.data[i].uuid + `" class="btn btn-outline-primary"><i class="far fa-edit"></i></button>
                        <button id="deleteData" data-uuid="` + res.data[i].uuid + `" class="btn btn-outline-danger""><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>`;
                }
            }
        } else {
            // Handle other cases or errors
            console.log('Error:', res.message);
        }

        $('#tbody').html(htmlView);

    }

    function showTabel() {
        $("#loading-row").show();

        $.ajax({
            type: 'GET',
            dataType: "json",
            url: url + '/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar',
            success: function (res) {
                table(res);
                $("#loading-row").hide();

                // Ambil data jenis surat dari respons API dan isi opsi pada elemen <select>
                const jenisSuratData = res.data.map(function (suratKeluar) {
                    return {
                        uuid: suratKeluar.jenis_surat.uuid,
                        jenis_surat: suratKeluar.jenis_surat.jenis_surat
                    };
                });
                fillJenisSuratOptions(jenisSuratData);
            },
            error: function (error) {
                console.log(error);
                $("#loading-row").hide();
            }
        })
    }

    $(document).ready(function () {
        $("#surat-keluar").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["csv", "excel"]
        }).buttons().container().appendTo('#surat-keluar_wrapper .col-md-6:eq(0)');
    });


    $(document).on('click', '#add-data', function () {
        $('#formData').trigger("reset");
        $('#modal-default').modal('show');
        $('#formData').attr('action', url + '/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/create');
        $('#btn-send').html('Kirim');
        $('.modal-title').html('Upsert Data');

    });

    $(document).on('click', '#editData', function () {
        let Uuid = $(this).data('uuid')
        $('.modal-title').html('Edit data');
        $('#btn-send').html("Save Change");
        $('#formData').attr('action', url + '/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/get/' + Uuid);

        $.get(`${url}/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/get/${Uuid}`, function (res) {
            for (const key in res) {
                $(`#${key}`).val(res[key])
            }
            $('#EditModal').modal('show')
        })
    });


    function fillJenisSuratOptions(jenisSuratData) {
        const selectElement = $('#id_jenis_surat');
        selectElement.empty();

        // Add a default option if needed
        // selectElement.append($('<option>').attr('value', '').text('Select Jenis Surat'));

        // Add options for each jenisSuratData item
        jenisSuratData.forEach(function (jenisSurat) {
            const option = $('<option>').attr('value', jenisSurat.uuid).text(jenisSurat.jenis_surat);
            selectElement.append(option);
        });
    }

    $('#formData').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            url: $(this).attr('action'),
            beforeSend: function () {
                $('#btn-send').addClass("disabled").html("Processing...").attr('disabled', true);
            },
            complete: function () {
                $('#btn-send').removeClass("disabled").html("Kirim").attr('disabled', false);
            },
            success: function (data) {
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
                    console.log(data);
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
        })
    })

</script>

@endsection
