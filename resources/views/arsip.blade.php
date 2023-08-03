@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Arsip</h1>
    </div>
</div>
@endsection
@section('main-content')
<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold ">Data arsip</h6>
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
                        <div class="form-group">
                            <label for="id_user">id_user</label>
                            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Input Here..">
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
@endsection