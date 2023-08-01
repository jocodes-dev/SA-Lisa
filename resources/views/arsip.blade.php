@extends('layouts/base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Arsip Surat</h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="card-title">Table Arsip Surat</h3>
                
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




<script>
    const Url = 'api/v3/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar';

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
                                <td>${data.asal_surat}</td>
                                <td>${data.no_surat}</td>
                                <td>${data.jenis_surat.jenis_surat}</td>
                                <td>${data.tanggal_surat}</td>
                                <td>${data.perihal}</td>
                                <td>
                                    <button id="delete-confirm" data-uuid="${data.uuid}" class="btn btn-info"><i class="fas fa-eye"></i></button>
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


</script>

@endsection
