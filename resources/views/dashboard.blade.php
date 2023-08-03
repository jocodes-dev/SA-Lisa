@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div>
</div>
@endsection
@section('main-content')
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="nav-icon fa-solid fa-file-arrow-down"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Surat Masuk</span>
        <span class="info-box-number" id="dataSuratMasuk"></span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="nav-icon fa-solid fa-file-arrow-up"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Surat Keluar</span>
        <span class="info-box-number" id="dataSuratKeluar"></span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="nav-icon fa-solid fa-file-lines"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jenis Surat</span>
        <span class="info-box-number" id="dataJenisSurat"></span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fa-solid fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total User</span>
        <span class="info-box-number" id="dataUser"></span>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12 mb-4 order-0">
<div class="card">
<div class="d-flex align-items-end row">
    <div class="col-sm-7">
        <div class="card-body">
            <h5 class="card-title text-primary">Selamat Datang Di Dashboard 🎉</h5>

            @auth
                      <p class="mb-4">{{ auth()->user()->name }}</p>
            @endauth

            <i class="fa-sharp fa-solid fa-face-smile text-warning"></i>
            <a href="javascript:;" class="">Enjoy your work !!!</a>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    $.ajax({
        url: `{{ url('count') }}`,
        method: "GET",
        dataType: "json",
        success: function(response) {
          const data = response.data
          $("#dataSuratMasuk").text(data.Surat_Masuk)
          $("#dataSuratKeluar").text(data.Surat_Keluar)
          $("#dataJenisSurat").text(data.Jenis_Surat)
          $("#dataUser").text(data.user)
        },
        error: function() {
            console.log("Failed to get data from server");
        }
    });
});
</script>
@endsection
