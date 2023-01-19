@extends('admin.layouts.auth')
@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <form action="{{route('reset_password')}}" method="post">
            @csrf
            <div class="input-group mt-3">
                <input name="pin_code" type="text" class="form-control" placeholder="Pin Code">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
            </div>
            @error('pin_code')
                <p class="text-danger text-sm">{{$message}}</p>
            @enderror
          <div class="input-group mt-3">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          @error('password')
            <p class="text-danger text-sm">{{$message}}</p>
          @enderror
          <div class="input-group mb-3">
            <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
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