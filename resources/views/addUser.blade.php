@extends('layouts/base')
@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Add User</h1>
    </div>
</div>
@endsection
@section('main-content')
<div class="card card-primary mx-5">
    <div class="card-header">
      <h3 class="card-title">Add User</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username">
          </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection