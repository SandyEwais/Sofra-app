@extends('admin.layouts.auth')
@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <form action="{{route('request_password')}}" method="post">
          @csrf
          <div class="input-group">
            <input name="email" value="{{old('email')}}" type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          @error('email')
            <p class="text-danger text-sm">{{$message}}</p>
          @enderror
          <div class="row mt-3">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Request new password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="{{route('login')}}">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection