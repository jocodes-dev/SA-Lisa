@extends('layouts/base')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Surat Masuk</h1>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabel Data Surat Masuk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="surat-masuk_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="surat-masuk" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                aria-describedby="surat-masuk_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="surat-masuk" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="No: activate to sort column descending">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="Nama User: activate to sort column ascending">Nama User</th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="No. Surat: activate to sort column ascending">No. Surat</th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="Tanggal Masuk Surat: activate to sort column ascending">Tanggal
                                            Masuk Surat
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="Perihal: activate to sort column ascending">Perihal</th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="File Surat Masuk: activate to sort column ascending">File Surat</th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="Asal Surat: activate to sort column ascending">Asal Surat</th>
                                        <th class="sorting" tabindex="0" aria-controls="surat-masuk" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">1</td>
                                        <td>Aziz</td>
                                        <td>144/01/PLP-VII/2023</td>
                                        <td>21/07/2023</td>
                                        <td>Surat Keterangan Kurang Mampu</td>
                                        <td>A</td>
                                        <td>Lurah AXC</td>
                                        <td>hapus</td>
                                    </tr>
                                    <tr >
                                        <td class="dtr-control sorting_1" tabindex="0">2</td>
                                        <td>Budi</td>
                                        <td>144/02/PLP-VII/2023</td>
                                        <td>22/07/2023</td>
                                        <td>Surat Keterangan Kurang Mampu</td>
                                        <td>A</td>
                                        <td>Lurah AXC</td>
                                        <td>hapus</td>
                                    </tr>
                                    <tr>
                                        <td class="dtr-control sorting_1" tabindex="0">3</td>
                                        <td>Candra</td>
                                        <td>144/03/PLP-VII/2023</td>
                                        <td>23/07/2023</td>
                                        <td>Surat Keterangan Kurang Mampu</td>
                                        <td>A</td>
                                        <td>Lurah AXC</td>
                                        <td>hapus</td>
                                    </tr>
                                    <tr >
                                        <td class="dtr-control sorting_1" tabindex="0">4</td>
                                        <td>David</td>
                                        <td>144/04/PLP-VII/2023</td>
                                        <td>24/07/2023</td>
                                        <td>Surat Keterangan Kurang Mampu</td>
                                        <td>A</td>
                                        <td>Lurah AXC</td>
                                        <td>hapus</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">No</th>
                                        <th rowspan="1" colspan="1">Nama User</th>
                                        <th rowspan="1" colspan="1">No. Surat</th>
                                        <th rowspan="1" colspan="1">Tanggal Masuk Surat</th>
                                        <th rowspan="1" colspan="1">Perihal</th>
                                        <th rowspan="1" colspan="1">File Surat</th>
                                        <th rowspan="1" colspan="1">Asal Surat</th>
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
@endsection
@section('js-content')
    
    <script>
        $(function () {
            $("#surat-masuk").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#surat-masuk_wrapper .col-md-6:eq(0)');
        });

    </script>
@endsection
