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
      <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Surat Masuk</span>
        <span class="info-box-number">1,410</span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Surat Keluar</span>
        <span class="info-box-number">1,410</span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fa-solid fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">User</span>
        <span class="info-box-number">1,410</span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
</div>
@endsection