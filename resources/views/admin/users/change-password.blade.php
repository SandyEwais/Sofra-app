@extends('admin.layouts.app')
@section('title','Change Password')
@section('content')
<div class="card card-primary">
    <form id="quickForm" novalidate="novalidate" action="{{route('set_password')}}" method="POST">
        @csrf
        @if (session('error'))
            <div x-data={show:true} x-init="setTimeout(() => show =false,3000)">
                <div x-show="show" x-transition.duration.500ms class="alert alert-danger alert-dismissible">
                    {{session('error')}}
                </div>
            </div>
        @endif
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input name="password_old" type="password" class="form-control" placeholder="Enter Old Password">
                @error('password_old')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input name="password" type="password" class="form-control" placeholder="Enter New Password">
                @error('password')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                @error('password_confirmation')
                    <p class="text-danger text-sm">{{$message}}</p>
                @enderror
            </div>
        </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>
</div>
@endsection