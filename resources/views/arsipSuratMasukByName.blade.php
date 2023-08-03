@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Arsip Surat Masuk / by name</h1>
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
                    <th>Jenis surat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="dataTable">
               
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

</div>

<script>
$(document).ready(function() {
    // handle cetak data
    var dataTable = $("#dataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["csv", "excel"]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
    $.ajax({
        url: "{{ url('v1/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat') }}",
        method: "GET",
        dataType: "json",
        success: function(response) {
            var tableBody = "";
            // console.log(response, '<-- jika berhasil');
            $.each(response.data, function(index, item) {
                tableBody += /*html*/
                    `<tr>
                        <td>${(index + 1)}</td> 
                        <td>${item.jenis_surat}</td>
                        <td>
                            <button class='btn btn-warning download-link' data-filename="">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            
                        </td>
                    </tr>`
            });

            var table = $("#dataTable").DataTable();
            table.clear().draw();
            table.rows.add($(tableBody)).draw();
        },
        error: function(error) {
            console.log(error, "Failed to get data from server");
        }
    });
});
</script>
@endsection